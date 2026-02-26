<?php

namespace App\Http\Controllers;

use App\Models\KelompokBarang;
use Illuminate\Http\Request;

class KelompokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelompoks = KelompokBarang::orderBy('urutan')
            ->paginate(10);

        return view('kelompok.index', compact('kelompoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelompok.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama_kelompok' => 'required',
    ]);

    // Hitung jumlah kelompok yang sudah ada
    $count = KelompokBarang::count();

    // Format kode: 01, 02, 03...
    $kode = str_pad($count + 1, 2, '0', STR_PAD_LEFT);

    KelompokBarang::create([
        'kode_kelompok' => $kode,
        'nama_kelompok' => $request->nama_kelompok,
        'deskripsi'     => $request->deskripsi,
        'is_active'     => true,
    ]);

    return redirect()->route('kelompok.index')
        ->with('success', 'Kelompok barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KelompokBarang $kelompok)
    {
        return view('kelompok.show', compact('kelompok'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelompokBarang $kelompok)
    {
        return view('kelompok.edit', compact('kelompok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KelompokBarang $kelompok)
    {
        $request->validate([
            'kode_kelompok' => 'required|unique:kelompok_barangs,kode_kelompok,' . $kelompok->id,
            'nama_kelompok' => 'required',
        ]);

        $kelompok->update([
        // 'kode_kelompok' => $request->kode_kelompok,
            'nama_kelompok' => $request->nama_kelompok,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kelompok.index')
            ->with('success', 'Kelompok barang berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KelompokBarang $kelompok)
    {
        $kelompok->delete();

        return redirect()->route('kelompok.index')
            ->with('success', 'Kelompok barang berhasil dihapus');
    }
}
