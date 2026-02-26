<?php

namespace App\Http\Controllers;

use App\Models\SubJenisBarang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class SubJenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjenis = SubJenisBarang::with('jenis')
        ->orderBy('kode_subjenis')
        ->paginate(10);

        return view('subjenis.index', compact('subjenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisList = JenisBarang::where('is_active', true)->get();
        return view('subjenis.create', compact('jenisList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'jenis_barang_id' => 'required|exists:jenis_barangs,id',
        'nama_subjenis'   => 'required',
    ]);

    $jenisId = $request->jenis_barang_id;

    // Ambil data jenis induk
    $jenis = JenisBarang::findOrFail($jenisId);

    $last = SubJenisBarang::where('jenis_barang_id', $jenisId)
    ->max('kode_subjenis');
    
    // Hitung jumlah subjenis dalam jenis ini
    if (!$last) {
        $urut = 1;
    } else {
        $explode = explode('.', $last);
        $lastNumber = intval($explode[1]);
        $urut = $lastNumber + 1;
    }

    // Format urutan: 01, 02, 03...
    $formatUrut = str_pad($urut, 2, '0', STR_PAD_LEFT);

    // Gabungkan kode jenis + urutan
    $kodeSubjenis = $jenis->kode_jenis . '.' . $formatUrut;

    SubJenisBarang::create([
        'jenis_barang_id' => $jenisId,
        'kode_subjenis'   => $kodeSubjenis,
        'nama_subjenis'   => $request->nama_subjenis,
        'deskripsi'       => $request->deskripsi,
        'is_active'       => true,
    ]);

    return redirect()->route('subjenis.index')
        ->with('success', 'Sub Jenis berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubJenisBarang $subjenis)
    {
        return view('subjenis.show', compact('subjenis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubJenisBarang $subjenis)
    {
        $jenisList = JenisBarang::where('is_active', true)->get();
        return view('subjenis.edit', compact('subjenis', 'jenisList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubJenisBarang $subjenis)
    {
        $request->validate([
            'jenis_barang_id' => 'required|exists:jenis_barangs,id',
            'kode_subjenis'   => 'required|unique:sub_jenis_barangs,kode_subjenis,' . $subjenis->id,
            'nama_subjenis'   => 'required',
        ]);

        $subjenis->update($request->all());

        return redirect()->route('subjenis.index')
            ->with('success', 'Sub Jenis berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubJenisBarang $subjenis)
    {
        $subjenis->delete();

        return redirect()->route('subjenis.index')
            ->with('success', 'Sub Jenis berhasil dihapus');
    }
}
