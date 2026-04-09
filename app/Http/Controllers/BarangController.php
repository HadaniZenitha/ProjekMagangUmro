<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\SubJenisBarang;
use App\Models\Divisi;
use App\Models\Ruang;
use App\Models\Pic;
use App\Models\BarangHistory;
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

        // Filter Divisi
        if ($request->divisi) {
            $query->where('divisi_id', $request->divisi);
        }

        // Filter PIC
        if ($request->pic) {
            $query->where('pic_id', $request->pic);
        }

        // Filter Ruangan
        if ($request->ruang) {
            $query->where('ruang_id', $request->ruang);
        }

        // Filter Tahun
        if ($request->tahun) {
            $query->where('tahun_perolehan', $request->tahun);
        }

        // Filter Status
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

        return view('barang.index', compact(
            'barangs',
            'divisis',
            'pics',
            'ruangs'
        ));
    }


    public function create()
    {
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
        $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'sub_jenis_barang_id' => 'required|exists:sub_jenis_barangs,id',
            'pic_id' => 'required|exists:pics,id',
            'nama_barang' => 'required'
        ]);

        $divisi = Divisi::findOrFail($request->divisi_id);
        $ruang = Ruang::findOrFail($request->ruang_id);

        $subjenis = SubJenisBarang::with('jenis.kelompok')
            ->findOrFail($request->sub_jenis_barang_id);

        $kelompok = $subjenis->jenis->kelompok;
        $tahun = $request->tahun_perolehan;

        $lastUrutan = Barang::where('sub_jenis_barang_id', $subjenis->id)
            ->max('urutan');

        $urutanBaru = $lastUrutan ? $lastUrutan + 1 : 1;
        $formatUrutan = str_pad($urutanBaru, 2, '0', STR_PAD_LEFT);

        $kodeBarang =
            $kelompok->kode_kelompok . '/' .
            $subjenis->kode_subjenis . '/' .
            $formatUrutan . '/' .
            $tahun . '/' .
            $ruang->nama_ruang;

        Barang::create([
            'divisi_id' => $divisi->id,
            'ruang_id' => $request->ruang_id,
            'sub_jenis_barang_id' => $request->sub_jenis_barang_id,
            'pic_id' => $request->pic_id,
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            // 'merk' => $request->merk,
            // 'serial_number' => $request->serial_number,
            'tahun_perolehan' => $request->tahun_perolehan,
            'kondisi' => $request->kondisi,
            'urutan' => $urutanBaru,
            'is_active' => true,
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
        // VALIDASI (TANPA is_active BIAR TIDAK ERROR)
        $request->validate([
            'nama_barang' => 'required',
            'pic_id' => 'required|exists:pics,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'kondisi' => 'required',
            'tahun_perolehan' => 'required',
        ]);

        // UPDATE DATA
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'pic_id' => $request->pic_id,
            'ruang_id' => $request->ruang_id,
            'tahun_perolehan' => $request->tahun_perolehan,
            'kondisi' => $request->kondisi,

            // AMAN: kalau tidak ada input, tetap pakai data lama
            'is_active' => $barang->is_active,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }


    public function scan($kode)
    {
        $barang = Barang::where('kode_barang', $kode)
            ->where('is_active', true)
            ->firstOrFail();

        return view('barang.scan', compact('barang'));
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
            'laporan_barang.xlsx'
        );
    }


    public function exportPdf(Request $request)
    {
        $query = $this->buildFilterQuery($request);

        $barangs = $query->with([
            'divisi',
            'pic',
            'ruang',
            'barangHistories' => function ($q) {
                $q->select('barang_id', 'kondisi', 'is_active', 'catatan', 'tanggal_perubahan')
                    ->orderBy('tanggal_perubahan', 'desc');
            }
        ])->get();

        // Proses kondisi per tahun (5 tahun terakhir + tahun perolehan)
        $tahunSekarang = (int) date('Y');
        $tahunRange = range($tahunSekarang - 4, $tahunSekarang); // 5 tahun terakhir

        $processedData = $barangs->map(function ($barang) use ($tahunRange, $tahunSekarang) {
            $kondisiPerTahun = [];

            // Kondisi terkini dari tabel barangs
            if ($barang->kondisi) {
                $kondisiPerTahun[$barang->tahun_perolehan ?? $tahunSekarang] = ucfirst($barang->kondisi); // tahun perolehan
                $kondisiPerTahun[$tahunSekarang] = ucfirst($barang->kondisi); // kondisi sekarang
            }

            // Ambil dari history
            foreach ($barang->barangHistories as $history) {
                $tahun = (int) $history->tanggal_perubahan->format('Y');
                if (!isset($kondisiPerTahun[$tahun])) {
                    $kondisiPerTahun[$tahun] = ucfirst($history->kondisi ?? 'Baik');
                }
            }

            // Gabungkan range yang diinginkan
            $tahunList = collect($tahunRange)
                ->merge([$barang->tahun_perolehan ?? $tahunSekarang])
                ->unique()
                ->sort()
                ->values();

            $barang->kondisi_per_tahun = $kondisiPerTahun;
            $barang->tahun_list_for_this = $tahunList; // per barang

            return $barang;
        });

        // Daftar tahun unik untuk header tabel (supaya semua baris sama)
        $allTahun = $processedData->flatMap(fn($b) => $b->tahun_list_for_this)->unique()->sort()->values();

        $pdf = Pdf::loadView('barang.export-pdf', [
            'data' => $processedData,
            'tahun_list' => $allTahun,
            'filter' => $request->all()
        ]);

        $pdf->setPaper('A4', 'landscape');   // sangat direkomendasikan karena banyak kolom tahun

        return $pdf->stream('laporan_inventaris_barang_' . date('Ymd') . '.pdf');
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


    private function buildFilterQuery($request)
    {
        $query = Barang::with(['divisi', 'pic', 'ruang']);

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