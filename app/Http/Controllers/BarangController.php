<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\SubJenisBarang;
use App\Models\Divisi;
use App\Models\Ruang;
use App\Models\Pic;
use App\Models\PerluPerbaikan;
use App\Models\BarangRusak;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangExport;
use App\Imports\BarangImport;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    public function index(Request $request)
    {
<<<<<<< HEAD
        $query = Barang::with('divisi','pic','ruang')
                ->orderBy('kode_barang');

        if ($request->divisi_id) {
            $query->where('divisi_id', $request->divisi_id);
        }

        $barangs = $query->paginate(10);

        return view('barang.index', compact('barangs'));
=======
        $query = Barang::with(['divisi','ruang','pic']);

        // Filter berdasarkan divisi
        if ($request->divisi) {
            $query->where('divisi_id', $request->divisi);
        }

        // Filter berdasarkan tahun (created_at)
        if ($request->tahun) {
            $query->whereYear('created_at', $request->tahun);
        }

        // Filter berdasarkan status aktif
        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

    $barangs = $query->paginate(15);

        $divisis = Divisi::orderBy('nama_divisi')->get();
        $pics = Pic::with('divisi')->where('is_active', true)->get();

        return view('barang.index', compact('barangs','divisis', 'pics'));
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
    }

    public function create()
    {
        $divisis = Divisi::where('is_active', true)->get();
        $ruangs = Ruang::where('is_active', true)->get();
        $subjenisList = SubJenisBarang::with('jenis')
                        ->where('is_active', true)
                        ->orderBy('kode_subjenis')
                        ->get();
        $pics = Pic::with('divisi')->where('is_active', true)->get();

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

<<<<<<< HEAD
        $lastUrutan = Barang::where('divisi_id', $divisi->id)
=======
        // ambil urutan terakhir
        $lastUrutan = Barang::where('sub_jenis_barang_id', $subjenis->id)
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
            ->max('urutan');
        $urutanBaru = $lastUrutan ? $lastUrutan + 1 : 1;
        $formatUrutan = str_pad($urutanBaru, 2, '0', STR_PAD_LEFT);

        $kodeBarang =
        $kelompok->kode_kelompok . '/' .
        $subjenis->kode_subjenis . '/' .
        $formatUrutan . '/' .
        $tahun . '/' .
        $ruang->nama_ruang;

        $barang = Barang::create([
            'divisi_id' => $divisi->id,
            'ruang_id' => $request->ruang_id,
            'sub_jenis_barang_id' => $request->sub_jenis_barang_id,
            'pic_id' => $request->pic_id,
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'serial_number' => $request->serial_number,
            'tahun_perolehan' => $request->tahun_perolehan,
            'kondisi' => $request->kondisi,
            'urutan' => $urutanBaru,
            'is_active' => true,
        ]);

        // jika barang perlu perbaikan
        if ($request->keterangan == 'Perlu Perbaikan') {
            PerluPerbaikan::create([
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $kodeBarang,
                'ruang' => $request->ruang_id,
                'keterangan' => 'Barang perlu diperbaiki'
            ]);
        }

        // jika barang rusak
        if ($request->keterangan == 'Rusak') {
            BarangRusak::create([
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $kodeBarang,
                'ruang' => $request->ruang_id,
                'keterangan' => 'Barang rusak'
            ]);
        }

        // jika barang baik (tidak perlu perbaikan dan tidak rusak)
        if ($request->keterangan != 'Perlu Perbaikan' && $request->keterangan != 'Rusak') {
            $request->merge(['keterangan' => 'Baik']); // otomatis set keterangan 'Baik'
        }

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
        $pics = Pic::with('divisi')->where('is_active', true)->get();

        return view('barang.edit', compact(
            'barang',
            'divisis',
            'ruangs',
            'pics'
        ));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'pic_id' => 'required|exists:pics,id',
            'is_active' => 'required|boolean'
        ]);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'pic_id' => $request->pic_id,
            'merk' => $request->merk,
            'serial_number' => $request->serial_number,
            'tahun_perolehan' => $request->tahun_perolehan,
            'kondisi' => $request->kondisi,
            'ruang_id' => $request->ruang_id,
            'is_active' => $request->is_active,
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
                ->get();
    
        return response()->json($pics);
    }

    public function exportExcel(Request $request)
    {
        $data = $this->buildFilterQuery($request)->get();

<<<<<<< HEAD
        $data = $query->get()->map(function ($b) {
            return [
                $b->kode_barang,
                $b->nama_barang,
                $b->divisi->nama_divisi ?? '-',
                $b->pic->nama_pic ?? '-',
                $b->ruang->nama_ruang ?? '-',
                $b->is_active ? 'Aktif' : 'Nonaktif'
            ];
        });
=======
        return Excel::download(
            new BarangExport($data),
            'laporan_barang.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $data = $this->buildFilterQuery($request)->get();
    
        $pdf = Pdf::loadView('barang.export-pdf', compact('data'));
    
        return $pdf->stream('laporan_barang.pdf');
    }
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf

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

<<<<<<< HEAD
        Excel::import(new BarangImport, $request->file('file_excel'));

        return redirect()->route('barang.index')
            ->with('success', 'Data Barang berhasil diimport dari Excel!');
    }
=======
        $import = new BarangImport;
        Excel::import($import, $request->file('file_excel'));

        $successCount = $import->getSuccessCount();
        $failedCount = $import->getFailedCount();
        $failedRows = $import->getFailedRows();

        $message = "Import selesai: {$successCount} barang berhasil ditambahkan";
        
        if ($failedCount > 0) {
            $message .= ", {$failedCount} baris gagal.";
            
            // Simpan detail error untuk ditampilkan
            session()->flash('import_errors', $failedRows);
            session()->flash('warning', $message);
        } else {
            session()->flash('success', $message);
        }

        return redirect()->route('barang.index');
    }

    /**
     * Build query untuk filter Excel/PDF/Preview
     */
    private function buildFilterQuery($request)
    {
        $query = Barang::with(['divisi','pic','ruang']);

        if ($request->divisi) {
        $query->whereHas('pic', function($q) use ($request) {
            $q->where('divisi_id', $request->divisi);
        });
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

        return $query;
    }
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
}