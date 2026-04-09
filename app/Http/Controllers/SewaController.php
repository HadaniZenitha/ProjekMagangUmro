<?php

namespace App\Http\Controllers;

use App\Models\BarangSewa;
use App\Models\Ruang;
use App\Models\Pic;
use App\Models\Divisi;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangSewa::with(['pic', 'ruang', 'divisi']);

        // Filter PIC
        if ($request->pic) {
            $query->where('pic_id', $request->pic);
        }

        // Filter Ruang
        if ($request->ruang) {
            $query->where('ruang_id', $request->ruang);
        }

        // Filter Tahun
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        // Filter Fungsi (Divisi)
        if ($request->fungsi) {
            $query->where('fungsi_id', $request->fungsi);
        }

        $data = $query->paginate(15)->withQueryString();

        $pics = Pic::where('is_active', true)->get();
        $ruangs = Ruang::where('is_active', true)->get();
        $divisis = Divisi::all();

        return view('sewa.index', compact('data', 'pics', 'ruangs', 'divisis'));
    }


    public function create()
    {
        $pics = Pic::where('is_active', true)->get();
        $ruangs = Ruang::where('is_active', true)->get();
        $divisis = Divisi::all(); // ✅ TAMBAH INI

        return view('sewa.create', compact('pics', 'ruangs', 'divisis'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang_sewas,kode_barang',
            'nama_barang' => 'required',
            'pic_id' => 'required|exists:pics,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'fungsi_id' => 'required|exists:divisis,id', // ✅ UBAH
            'tahun' => 'required|numeric',
            'kondisi' => 'required'
        ]);

        BarangSewa::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'fungsi_id' => $request->fungsi_id, // ✅ UBAH
            'pic_id' => $request->pic_id,
            'ruang_id' => $request->ruang_id,
            'tahun' => $request->tahun,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('barang-sewa.index')
            ->with('success', 'Barang sewa berhasil ditambahkan');
    }


    public function show(BarangSewa $sewa)
    {
        $data = $sewa->load(['pic', 'ruang', 'divisi']); // ✅ relasi

        return view('sewa.show', compact('data'));
    }


    public function edit(BarangSewa $sewa)
    {
        $data = $sewa;

        $pics = Pic::where('is_active', true)->get();
        $ruangs = Ruang::where('is_active', true)->get();
        $divisis = Divisi::all(); // ✅ TAMBAH INI

        return view('sewa.edit', compact('data', 'pics', 'ruangs', 'divisis'));
    }


    public function update(Request $request, BarangSewa $sewa)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang_sewas,kode_barang,' . $sewa->id,
            'nama_barang' => 'required',
            'pic_id' => 'required|exists:pics,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'fungsi_id' => 'required|exists:divisis,id', // ✅ UBAH
            'tahun' => 'required|numeric',
            'kondisi' => 'required'
        ]);

        $sewa->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'fungsi_id' => $request->fungsi_id, // ✅ UBAH
            'pic_id' => $request->pic_id,
            'ruang_id' => $request->ruang_id,
            'tahun' => $request->tahun,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('barang-sewa.index')
            ->with('success', 'Barang sewa berhasil diupdate');
    }


    public function destroy(BarangSewa $sewa)
    {
        $sewa->delete();

        return redirect()->route('barang-sewa.index')
            ->with('success', 'Barang sewa berhasil dihapus');
    }
}