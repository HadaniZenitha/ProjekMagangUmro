<?php

namespace App\Http\Controllers;

use App\Models\BarangSewa;
use App\Models\Divisi;
use App\Models\Ruang;
use App\Models\Pic;
use Illuminate\Http\Request;

class SewaController extends Controller
{

    public function index(Request $request)
    {
        $query = BarangSewa::with(['pic','ruang']);

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

        $data = $query->paginate(15)->withQueryString();

        $pics = Pic::where('is_active', true)->get();
        $ruangs = Ruang::where('is_active', true)->get();

        return view('sewa.index', compact('data','pics','ruangs'));
    }


    public function create()
    {
        $divisis = Divisi::where('is_active', true)->orderBy('nama_divisi')->get();
        $ruangs = Ruang::where('is_active', true)->get();

        return view('sewa.create', compact('divisis', 'ruangs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang_sewa,kode_barang',
            'nama_barang' => 'required',
            'divisi_id' => 'required|exists:divisis,id',
            'pic_id' => 'required|exists:pics,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'tahun' => 'required|numeric',
            'kondisi' => 'required'
        ]);

        $divisi = Divisi::findOrFail($request->divisi_id);

        BarangSewa::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'fungsi' => $divisi->nama_divisi,
            'pic_id' => $request->pic_id,
            'ruang_id' => $request->ruang_id,
            'tahun' => $request->tahun,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('barang-sewa.index')
            ->with('success', 'Barang sewa berhasil ditambahkan');
    }


    public function edit(BarangSewa $sewa)
    {
        $divisis = Divisi::where('is_active', true)->orderBy('nama_divisi')->get();
        $ruangs = Ruang::where('is_active', true)->get();
        $selectedDivisi = Divisi::where('nama_divisi', $sewa->fungsi)->first();
        $pics = $selectedDivisi
            ? Pic::where('divisi_id', $selectedDivisi->id)->where('is_active', true)->orderBy('nama_pic')->get()
            : collect();

        return view('sewa.edit', compact('sewa', 'divisis', 'pics', 'ruangs', 'selectedDivisi'));
    }


    public function show(BarangSewa $sewa)
    {
        $sewa->load(['ruang']);

        return view('sewa.show', compact('sewa'));
    }


    public function update(Request $request, BarangSewa $sewa)
    {
        $request->validate([
            'nama_barang' => 'required',
            'divisi_id' => 'required|exists:divisis,id',
            'pic_id' => 'required|exists:pics,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'tahun' => 'required|numeric',
            'kondisi' => 'required'
        ]);

        $divisi = Divisi::findOrFail($request->divisi_id);

        $sewa->update([
            'nama_barang' => $request->nama_barang,
            'fungsi' => $divisi->nama_divisi,
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