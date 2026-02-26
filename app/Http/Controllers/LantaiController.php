<?php

namespace App\Http\Controllers;

use App\Models\Lantai;
use App\Models\Gedung;
use Illuminate\Http\Request;

class LantaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lantais = Lantai::with('gedung')
            ->orderBy('gedung_id')
            ->orderBy('kode_lantai')
            ->get();

        return view('lantai.index', compact('lantais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gedungs = Gedung::where('is_active', true)
            ->orderBy('kode_gedung')
            ->get();

        return view('lantai.create', compact('gedungs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required|exists:gedungs,id',
            'kode_lantai' => 'required',
        ]);

        Lantai::create([
            'gedung_id' => $request->gedung_id,
            'kode_lantai' => strtoupper($request->kode_lantai),
            'nama_lantai' => $request->nama_lantai,
            'is_active' => true,
        ]);

        return redirect()->route('lantai.index')
            ->with('success', 'Lantai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lantai $lantai)
    {
        $lantai->load('gedung');

        return view('lantai.show', compact('lantai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lantai $lantai)
    {
        $gedungs = Gedung::orderBy('kode_gedung')->get();

        return view('lantai.edit', compact('lantai', 'gedungs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lantai $lantai)
    {
        $request->validate([
            'gedung_id' => 'required|exists:gedungs,id',
            'kode_lantai' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $lantai->update([
            'gedung_id' => $request->gedung_id,
            'kode_lantai' => strtoupper($request->kode_lantai),
            'nama_lantai' => $request->nama_lantai,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('lantai.index')
            ->with('success', 'Lantai berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lantai $lantai)
    {
        $lantai->delete();

        return redirect()->route('lantai.index')
            ->with('success', 'Lantai berhasil dihapus');
    }
}
