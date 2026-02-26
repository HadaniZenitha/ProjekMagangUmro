<?php

namespace App\Http\Controllers;

use App\Models\JenisRuangan;
use Illuminate\Http\Request;

class JenisRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisRuangans = JenisRuangan::orderBy('kode_jenis_ruangan')->get();
        return view('jenis_ruangan.index', compact('jenisRuangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis_ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_jenis_ruangan' => 'required|unique:jenis_ruangans,kode_jenis_ruangan',
            'nama_jenis_ruangan' => 'required',
        ]);

        JenisRuangan::create([
            'kode_jenis_ruangan' => strtoupper($request->kode_jenis_ruangan),
            'nama_jenis_ruangan' => $request->nama_jenis_ruangan,
            'is_active' => true,
        ]);

        return redirect()->route('jenis-ruangan.index')
            ->with('success', 'Jenis Ruangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisRuangan $jenis_ruangan)
    {
        return view('jenis_ruangan.show', compact('jenis_ruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisRuangan $jenis_ruangan)
    {
        return view('jenis_ruangan.edit', compact('jenis_ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisRuangan $jenis_ruangan)
    {
        $request->validate([
            'kode_jenis_ruangan' =>
                'required|unique:jenis_ruangans,kode_jenis_ruangan,' . $jenis_ruangan->id,
            'nama_jenis_ruangan' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $jenis_ruangan->update([
            'kode_jenis_ruangan' => strtoupper($request->kode_jenis_ruangan),
            'nama_jenis_ruangan' => $request->nama_jenis_ruangan,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('jenis-ruangan.index')
            ->with('success', 'Jenis Ruangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisRuangan $jenis_ruangan)
    {
        $jenis_ruangan->delete();

        return redirect()->route('jenis-ruangan.index')
            ->with('success', 'Jenis Ruangan berhasil dihapus');
    }
}
