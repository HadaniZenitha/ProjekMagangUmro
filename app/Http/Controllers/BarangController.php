<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\SubJenisBarang;
use App\Models\Divisi;
use App\Models\Ruang;
use App\Models\Pic;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangExport;
use App\Imports\BarangImport;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{

    public function index(Request $request)
    {
        $query = Barang::with(['divisi', 'ruang', 'pic'])->latest('updated_at');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->divisi) {
            $query->where('divisi_id', $request->divisi);
        }

        if ($request->pic) {
            $query->where('pic_id', $request->pic);
        }

        if ($request->ruang) {
            $query->where('ruang_id', $request->ruang);
        }

        if ($request->tahun_awal && $request->tahun_akhir) {
            $query->whereBetween('tahun_perolehan', [
                $request->tahun_awal,
                $request->tahun_akhir
            ]);
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $barangs = $query->paginate(15)->withQueryString();

        $divisis = Divisi::orderBy('nama_divisi')->get();

        $pics = Pic::with('divisi')
            ->where('is_active', true)
            ->orderBy('nama_pic')
            ->get();

        $ruangs = Ruang::where('is_active', true)
            ->orderBy('nama_ruang')
            ->get();

        // 🔥 FIX ERROR DI SINI
        $barangList = Barang::select('id', 'kode_barang', 'nama_barang')
            ->orderBy('kode_barang')
            ->get();

        return view('barang.index', compact(
            'barangs',
            'divisis',
            'pics',
            'ruangs',
            'barangList'
        ));
    }


    public function create()
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $divisis = Divisi::where('is_active', true)->get();

        $ruangs = Ruang::where('is_active', true)->get();

        $subjenisList = SubJenisBarang::with('jenis')
            ->where('is_active', true)
            ->orderBy('kode_subjenis')
            ->get();

        $pics = Pic::with('divisi')
            ->where('is_active', true)
            ->get();

        return view('barang.create', compact(
            'divisis',
            'ruangs',
            'subjenisList',
            'pics'
        ));
    }


    public function store(Request $request)
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $request->validate([
            'divisi_id'           => 'nullable|exists:divisis,id',
            'ruang_id'            => 'required|exists:ruangs,id',
            'sub_jenis_barang_id' => 'required|exists:sub_jenis_barangs,id',
            'pic_id'              => 'nullable|exists:pics,id',
            'nama_barang'         => 'required|string|max:255',
            'tahun_perolehan'     => 'required|integer',
            'kondisi'             => 'required|in:baik,perlu perbaikan,rusak',
            'foto'                => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 1. Ambil data Ruangan beserta relasi PIC dan Divisi-nya
        // Asumsi: Di model Ruang ada relasi 'pic', dan di model Pic ada relasi 'divisi'
        $ruang = Ruang::with('pic.divisi')->findOrFail($request->ruang_id);
    
        // 2. Logika Otomatisasi PIC
        $finalPicId = $request->pic_id;
        if (empty($finalPicId)) {
            $finalPicId = $ruang->pic_id;
        }
    
        // 3. Logika Otomatisasi Divisi
        $finalDivisiId = $request->divisi_id;
        if (empty($finalDivisiId)) {
            // Ambil divisi dari PIC yang terpilih (baik dari input maupun dari default ruangan)
            if (!empty($finalPicId)) {
                $picTerkait = Pic::find($finalPicId);
                $finalDivisiId = $picTerkait->divisi_id;
            }
        }
    
        // Validasi Akhir: Jika setelah dicek otomatis tetap kosong (misal ruangan belum diset PIC-nya)
        if (empty($finalPicId) || empty($finalDivisiId)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal otomatisasi: Mohon pilih Divisi & PIC secara manual karena data default ruangan tidak lengkap.');
        }

        $subjenis = SubJenisBarang::with('jenis.kelompok')
            ->findOrFail($request->sub_jenis_barang_id);

        $kelompok = $subjenis->jenis->kelompok;
        $tahun = $request->tahun_perolehan;

        $lastUrutan = Barang::where('sub_jenis_barang_id', $subjenis->id)
            ->max('urutan');

        $urutanBaru = $lastUrutan ? $lastUrutan + 1 : 1;
        $formatUrutan = str_pad($urutanBaru, 2, '0', STR_PAD_LEFT);

        $kodeBarang =
            $kelompok->kode_kelompok . ' / ' .
            $subjenis->kode_subjenis . ' / ' .
            $formatUrutan . ' / ' .
            $tahun . ' / ' .
            $ruang->nama_ruang;

        // Handle upload foto dengan nama sesuai kode barang
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();

            // Nama file: kode_barang + timestamp + extension
            $fileName = str_replace('/', '-', $kodeBarang) . '_' . now()->format('Ymd_His') . '.' . $extension;

            $fotoPath = $file->storeAs('barang_foto', $fileName, 'public');
        }

        Barang::create([
            'divisi_id'           => $finalDivisiId,
            'ruang_id'            => $request->ruang_id,
            'sub_jenis_barang_id' => $request->sub_jenis_barang_id,
            'pic_id'              => $finalPicId,
            'kode_barang'         => $kodeBarang,
            'nama_barang'         => $request->nama_barang,
            'tahun_perolehan'     => $request->tahun_perolehan,
            'kondisi'             => $request->kondisi,
            'urutan'              => $urutanBaru,
            'is_active'           => true,
            'foto'                => $fotoPath,
            'catatan_nonaktif'    => $request->catatan_nonaktif ?? null,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }


    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }


    public function edit(Barang $barang)
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $divisis = Divisi::all();

        $ruangs = Ruang::all();

        $pics = Pic::with('divisi')
            ->where('is_active', true)
            ->get();

        // 🔥 TAMBAHKAN INI
        $subjenisList = SubJenisBarang::with('jenis')
            ->where('is_active', true)
            ->orderBy('kode_subjenis')
            ->get();

        return view('barang.edit', compact(
            'barang',
            'divisis',
            'ruangs',
            'pics',
            'subjenisList' // 🔥 WAJIB
        ));
    }

    public function update(Request $request, Barang $barang)
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $request->validate([
            'nama_barang'     => 'required|string|max:255',
            'divisi_id'       => 'required|exists:divisis,id',
            'pic_id'          => 'required|exists:pics,id',
            'ruang_id'        => 'required|exists:ruangs,id',
            'kondisi'         => 'required|in:baik,perlu perbaikan,rusak',
            'is_active'       => 'required|boolean',
            'tahun_perolehan' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'catatan_nonaktif' => 'nullable|string',
        ]);

        $fotoPath = $barang->foto;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($barang->foto) {
                \Storage::disk('public')->delete($barang->foto);
            }

            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();

            // Nama file tetap pakai kode barang yang sudah ada
            $fileName = str_replace('/', '-', $barang->kode_barang) . '_' . now()->format('Ymd_His') . '.' . $extension;

            $fotoPath = $file->storeAs('barang_foto', $fileName, 'public');
        }

        $barang->update([
            'nama_barang'         => $request->nama_barang,
            'divisi_id'           => $request->divisi_id,
            'pic_id'              => $request->pic_id,
            'tahun_perolehan'     => $request->tahun_perolehan,
            'kondisi'             => $request->kondisi,
            'ruang_id'            => $request->ruang_id,
            'is_active'           => $request->is_active,
            'foto'                => $fotoPath,
            'catatan_nonaktif'    => $request->is_active == 1 ? null : $request->catatan_nonaktif,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        // 1. Cek apakah barang memiliki foto
        if ($barang->foto) {
            // 2. Hapus file foto dari storage public
            if (\Storage::disk('public')->exists($barang->foto)) {
                \Storage::disk('public')->delete($barang->foto);
            }
        }
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }


    public function scanPage()
    {
        return view('barang.scan');
    }

    public function scan($kode)
    {
        $barang = Barang::where('kode_barang', $kode)
            ->where('is_active', true)
            ->firstOrFail();

        return redirect()->route('barang.show', $barang->id);
    }


    public function getByDivisi($divisiId)
    {
        $pics = Pic::where('divisi_id', $divisiId)
            ->where('is_active', true)
            ->orderBy('nama_pic')
            ->select('id', 'nama_pic', 'jabatan')
            ->get();

        return response()->json($pics);
    }



    public function exportExcel(Request $request)
    {
        $data = $this->buildFilterQuery($request)->get();

        return Excel::download(
            new BarangExport($data),
            'laporan_inventaris_' . date('Ymd_His') . '.xlsx'
        );
    }


    public function exportPdf(Request $request)
    {
        $query = $this->buildFilterQuery($request);

        $tahunSekarang = (int) date('Y');
        $tahunMulai = (int) $request->input('tahun_awal', $tahunSekarang - 4);
        $tahunSelesai = (int) $request->input('tahun_akhir', $tahunSekarang);

        $tahunRange = range($tahunMulai, $tahunSelesai);

        $barangs = $query->with([
            'divisi',
            'pic',
            'ruang',
            'barangHistories' => function ($q) use ($tahunMulai, $tahunSelesai) {
                $q->select('barang_id', 'kondisi', 'tahun_perolehan', 'tanggal_perubahan')
                    ->whereBetween('tahun_perolehan', [$tahunMulai, $tahunSelesai])
                    ->orderBy('tanggal_perubahan', 'asc');
            }
        ])->get();

        // Proses mapping kondisi per tahun
        $processedData = $barangs->map(function ($barang) use ($tahunRange, $tahunSekarang) {
            $kondisiPerTahun = array_fill_keys($tahunRange, '-');

            // Isi dari history (prioritas utama)
            // foreach ($barang->barangHistories as $history) {
            //     $tahunHistory = (int) $history->tanggal_perubahan->format('Y');

            //     if (isset($kondisiPerTahun[$tahunHistory])) {
            //         $kondisiPerTahun[$tahunHistory] = ucfirst($history->kondisi);
            //     }

            //     // Jika history menyimpan tahun_perolehan yang berbeda, gunakan juga
            //     if ($history->tahun_perolehan && isset($kondisiPerTahun[$history->tahun_perolehan])) {
            //         $kondisiPerTahun[$history->tahun_perolehan] = ucfirst($history->kondisi);
            //     }
            // }

            foreach ($barang->barangHistories as $history) {
                $tahun = (int) $history->tahun_perolehan;

                if (isset($kondisiPerTahun[$tahun])) {
                    // overwrite → ambil kondisi terbaru
                    $kondisiPerTahun[$tahun] = ucfirst($history->kondisi);
                }
            }

            // Pastikan tahun perolehan asli selalu terisi (jika masih kosong)
            $tahunPerolehan = (int) $barang->tahun_perolehan;
            if (isset($kondisiPerTahun[$tahunPerolehan]) && $kondisiPerTahun[$tahunPerolehan] === '-') {
                $kondisiPerTahun[$tahunPerolehan] = ucfirst($barang->kondisi);
            }

            // Tahun sekarang selalu menggunakan kondisi terkini
            if (isset($kondisiPerTahun[$tahunSekarang])) {
                $kondisiPerTahun[$tahunSekarang] = ucfirst($barang->kondisi);
            }

            $barang->kondisi_per_tahun = $kondisiPerTahun;

            return $barang;
        });

        // Render PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('barang.export-pdf', [
            'data' => $processedData,
            'tahun_list' => $tahunRange,
            'tahun_awal' => $tahunMulai,
            'tahun_akhir' => $tahunSelesai,
            'filter' => $request->all(),
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('laporan_inventaris_' . date('Ymd_His') . '.pdf');
    }

    public function exportPreview(Request $request)
    {
        $data = $this->buildFilterQuery($request)->get();

        return view('barang.export-preview', compact('data'));
    }


    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        $import = new BarangImport;

        Excel::import($import, $request->file('file_excel'));

        $successCount = $import->getSuccessCount();
        $failedCount = $import->getFailedCount();
        $failedRows = $import->getFailedRows();

        $message = "Import selesai: {$successCount} barang berhasil ditambahkan";

        if ($failedCount > 0) {

            $message .= ", {$failedCount} baris gagal.";

            session()->flash('import_errors', $failedRows);
            session()->flash('warning', $message);

        } else {

            session()->flash('success', $message);
        }

        return redirect()->route('barang.index');
    }


    private function buildFilterQuery(Request $request)
    {
        $query = Barang::with(['divisi', 'pic', 'ruang']);

        // Fungsi Pencarian Teks
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }
        
        if ($request->divisi) {
            $query->where('divisi_id', $request->divisi);
        }

        if ($request->pic) {
            $query->where('pic_id', $request->pic);
        }

        if ($request->ruang) {
            $query->where('ruang_id', $request->ruang);
        }

        if ($request->tahun) {
            $query->where('tahun_perolehan', $request->tahun);
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        if ($request->tahun_awal && $request->tahun_akhir) {
            $query->whereBetween('tahun_perolehan', [$request->tahun_awal, $request->tahun_akhir]);
        } elseif ($request->tahun) {
            $query->where('tahun_perolehan', $request->tahun);
        }

        return $query;
    }
    public function cetak(Barang $barang)
    {
        return view('barang.cetak', compact('barang'));
    }
    public function barcode($kode)
    {
        return view('barang.barcode', compact('kode'));
    }

}