<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use App\Models\KelompokBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = JenisBarang::with('kelompok')
            ->orderBy('urutan')
            ->paginate(10);

        return view('jenis.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelompoks = KelompokBarang::where('is_active', true)->get();
        return view('jenis.create', compact('kelompoks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama_jenis' => 'required',
        'kelompok_barang_id' => 'required|exists:kelompok_barangs,id',
    ]);

    $kelompok = KelompokBarang::findOrFail($request->kelompok_barang_id);

    // Ambil kode kelompok sebagai integer
    $kodeKelompok = intval($kelompok->kode_kelompok);

    // Basis: 01 → 100, 02 → 200, 03 → 300
    $baseKode = $kodeKelompok * 100;

    // Ambil kode terbesar dalam kelompok ini
    $lastKode = JenisBarang::where('kelompok_barang_id', $kelompok->id)
        ->max('kode_jenis');

    if (!$lastKode) {
        $nextKode = $baseKode;
    } else {
        $nextKode = $lastKode + 1;
    }

    JenisBarang::create([
        'kelompok_barang_id' => $kelompok->id,
        'kode_jenis' => $nextKode,
        'nama_jenis' => $request->nama_jenis,
        'deskripsi' => $request->deskripsi,
        'is_active' => true,
    ]);

    return redirect()->route('jenis.index')
        ->with('success', 'Jenis berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisBarang $jenis)
    {
        return view('jenis.show', compact('jenis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisBarang $jenis)
    {
        $kelompoks = KelompokBarang::where('is_active', true)->get();
        return view('jenis.edit', compact('jenis', 'kelompoks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisBarang $jenis)
    {
        $request->validate([
            'kelompok_barang_id' => 'required|exists:kelompok_barangs,id',
            'nama_jenis'         => 'required',
            'is_active' => 'required|boolean',
        ]);

        $kelompokBaruId = $request->kelompok_barang_id;

    // =========================
    // CEK APAKAH KELOMPOK BERUBAH
    // =========================
    if ($jenis->kelompok_barang_id != $kelompokBaruId) {

        $kelompokBaru = KelompokBarang::findOrFail($kelompokBaruId);

        $kodeKelompok = intval($kelompokBaru->kode_kelompok);
        $baseKode = $kodeKelompok * 100;

        $lastKode = JenisBarang::where('kelompok_barang_id', $kelompokBaruId)
            ->max('kode_jenis');

        if (!$lastKode) {
            $nextKode = $baseKode;
        } else {
            $nextKode = $lastKode + 1;
        }

        $jenis->kode_jenis = $nextKode;
        $jenis->kelompok_barang_id = $kelompokBaruId;
    }

        $jenis->update([
            'nama_jenis' => $request->nama_jenis,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
        ]);

        $jenis->save();
        
        return redirect()->route('jenis.index')
            ->with('success', 'Jenis barang berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisBarang $jenis)
    {
        $jenis->delete();

        return redirect()->route('jenis.index')
            ->with('success', 'Jenis barang berhasil dihapus');
    }
}
