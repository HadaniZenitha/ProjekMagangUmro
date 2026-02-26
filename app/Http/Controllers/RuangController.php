<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Lantai;
use App\Models\JenisRuangan;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangs = Ruang::with('lantai.gedung', 'jenisRuangan')
            ->orderBy('kode_ruang')
            ->get();

        return view('ruangs.index', compact('ruangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lantais = Lantai::with('gedung')->get();
        $jenisRuangans = JenisRuangan::where('is_active', true)->get();

        return view('ruangs.create', compact('lantais', 'jenisRuangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lantai_id' => 'required|exists:lantais,id',
            'jenis_ruangan_id' => 'required|exists:jenis_ruangans,id',
            'nama_ruang' => 'required'
        ]);

        $lantai = Lantai::with('gedung')->findOrFail($request->lantai_id);
        $jenis = JenisRuangan::findOrFail($request->jenis_ruangan_id);

        // Hitung urutan terbaru
        $lastUrutan = Ruang::where('lantai_id', $lantai->id)
            ->where('jenis_ruangan_id', $jenis->id)
            ->max('urutan');

        $urutanBaru = $lastUrutan ? $lastUrutan + 1 : 1;

        $formatUrutan = str_pad($urutanBaru, 2, '0', STR_PAD_LEFT);

        // Format kode ruang
        $kodeRuang = 
            $lantai->gedung->kode_gedung . '-' .
            $lantai->kode_lantai . '-' .
            $jenis->kode_jenis_ruangan . '-' .
            $formatUrutan;

        Ruang::create([
            'lantai_id' => $lantai->id,
            'jenis_ruangan_id' => $jenis->id,
            'nama_ruang' => $request->nama_ruang,
            'kode_ruang' => $kodeRuang,
            'urutan' => $urutanBaru,
            'is_active' => true,
        ]);

        return redirect()->route('ruangs.index')
            ->with('success', 'Ruang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruang $ruang)
    {
        return view('ruangs.show', compact('ruang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruang $ruang)
    {
        $lantais = Lantai::with('gedung')->get();
        $jenisRuangans = JenisRuangan::all();

        return view('ruangs.edit', compact('ruang', 'lantais', 'jenisRuangans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'nama_ruang' => 'required',
            'is_active' => 'required|boolean'
        ]);

        $ruang->update([
            'nama_ruang' => $request->nama_ruang,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('ruang.index')
            ->with('success', 'Ruang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruang $ruang)
    {
        $ruang->delete();

        return redirect()->route('ruangs.index')
            ->with('success', 'Ruang berhasil dihapus');
    }
}
