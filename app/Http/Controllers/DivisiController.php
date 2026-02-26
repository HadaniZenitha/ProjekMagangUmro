<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisis = Divisi::orderBy('kode_divisi')->get();
        return view('divisi.index', compact('divisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_divisi' => 'required|unique:divisis,kode_divisi',
            'nama_divisi' => 'required',
        ]);

        Divisi::create([
            'kode_divisi' => strtoupper($request->kode_divisi),
            'nama_divisi' => $request->nama_divisi,
            'is_active' => true,
        ]);

        return redirect()->route('divisi.index')
            ->with('success', 'Divisi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi)
    {
        return view('divisi.show', compact('divisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisi $divisi)
    {
        return view('divisi.edit', compact('divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisi $divisi)
    {
        $request->validate([
            'kode_divisi' => 'required|unique:divisis,kode_divisi,' . $divisi->id,
            'nama_divisi' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $divisi->update([
            'kode_divisi' => strtoupper($request->kode_divisi),
            'nama_divisi' => $request->nama_divisi,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('divisi.index')
            ->with('success', 'Divisi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisi $divisi)
    {
        $divisi->delete();

        return redirect()->route('divisi.index')
            ->with('success', 'Divisi berhasil dihapus');
    }
}
