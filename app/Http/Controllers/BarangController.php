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

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Barang::with('divisi','pic','ruang')
                ->orderBy('kode_barang');

        if ($request->divisi_id) {
            $query->where('divisi_id', $request->divisi_id);
        }

        // ambil data barang
        $barangs = $query->paginate(10);

        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
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

        $subjenis = SubJenisBarang::with('jenis.kelompok')
                    ->findOrFail($request->sub_jenis_barang_id);

        $kelompok = $subjenis->jenis->kelompok;

        $tahun = $request->tahun_perolehan;

        // ambil urutan terakhir
        $lastUrutan = Barang::where('divisi_id', $divisi->id)
            ->max('urutan');

        $urutanBaru = $lastUrutan ? $lastUrutan + 1 : 1;

        $formatUrutan = str_pad($urutanBaru, 2, '0', STR_PAD_LEFT);

        $kodeBarang =
        $kelompok->kode_kelompok . '/' .
        $subjenis->kode_subjenis . '/' .
        $formatUrutan . '/' .
        $tahun . '/' .
        $divisi->kode_divisi;

        Barang::create([
            'divisi_id' => $divisi->id,
            'ruang_id' => $request->ruang_id,
            'sub_jenis_barang_id' => $request->sub_jenis_barang_id,
            'pic_id' => $request->pic_id,
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'serial_number' => $request->serial_number,
            'tahun_perolehan' => $request->tahun_perolehan,
            'keterangan' => $request->keterangan,
            'urutan' => $urutanBaru,
            'is_active' => true,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $divisis = Divisi::all();
        $ruangs = Ruang::all();

        $pics = Pic::with('divisi')
                ->where('is_active', true)
                ->get();

        return view('barang.edit', compact(
            'barang',
            'divisis',
            'ruangs',
            'pics'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
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
            'keterangan' => $request->keterangan,
            'ruang_id' => $request->ruang_id,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }

    /**
     * Scan QR Code
     */
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

    public function export(Request $request)
    {
        $query = Barang::with('divisi','pic','ruang');

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

        return Excel::download(new BarangExport($data), 'laporan_barang.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new BarangImport, $request->file('file_excel'));

        return redirect()->route('barang.index')
            ->with('success', 'Data Barang berhasil diimport dari Excel!');
    }
}