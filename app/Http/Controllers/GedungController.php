<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gedungs = Gedung::orderBy('kode_gedung')->get();
        return view('gedung.index', compact('gedungs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gedung.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_gedung' => 'required|unique:gedungs,kode_gedung',
            'nama_gedung' => 'required',
        ]);

        Gedung::create([
            'kode_gedung' => strtoupper($request->kode_gedung),
            'nama_gedung' => $request->nama_gedung,
            'is_active' => true,
        ]);

        return redirect()->route('gedung.index')
            ->with('success', 'Gedung berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gedung $gedung)
    {
        return view('gedung.show', compact('gedung'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gedung $gedung)
    {
        return view('gedung.edit', compact('gedung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gedung $gedung)
    {
        $request->validate([
            'kode_gedung' => 'required|unique:gedungs,kode_gedung,' . $gedung->id,
            'nama_gedung' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $gedung->update([
            'kode_gedung' => strtoupper($request->kode_gedung),
            'nama_gedung' => $request->nama_gedung,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('gedung.index')
            ->with('success', 'Gedung berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gedung $gedung)
    {
        $gedung->delete();

        return redirect()->route('gedung.index')
            ->with('success', 'Gedung berhasil dihapus');
    }
}
