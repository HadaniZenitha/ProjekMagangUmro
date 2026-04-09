<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Lantai;
use App\Models\JenisRuangan;
use App\Models\Pic;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangs = Ruang::with('lantai.gedung', 'jenisRuangan', 'pic')
            ->orderBy('kode_ruang')
            ->paginate(15);

        return view('ruangs.index', compact('ruangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lantais = Lantai::with('gedung')->get();
        $jenisRuangans = JenisRuangan::where('is_active', true)->get();
        $pics = Pic::where('is_active', true)->orderBy('nama_pic')->get();

        return view('ruangs.create', compact('lantais', 'jenisRuangans', 'pics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lantai_id'        => 'required|exists:lantais,id',
            'jenis_ruangan_id' => 'required|exists:jenis_ruangans,id',
            'nama_ruang'       => 'required|string|max:255',
            'pic_id'           => 'nullable|exists:pics,id',
            'is_active'        => 'boolean',
        ], [
            'lantai_id.required'        => 'Lantai wajib dipilih.',
            'jenis_ruangan_id.required' => 'Jenis ruangan wajib dipilih.',
            'nama_ruang.required'       => 'Nama ruangan wajib diisi.',
            'pic_id.exists'             => 'PIC yang dipilih tidak valid.'
        ]);

        $lantai = Lantai::with('gedung')->findOrFail($validated['lantai_id']);
        $jenis = JenisRuangan::findOrFail($validated['jenis_ruangan_id']);

        $lastUrutan = Ruang::where('lantai_id', $lantai->id)
            ->where('jenis_ruangan_id', $jenis->id)
            ->max('urutan');

        $urutanBaru = $lastUrutan ? $lastUrutan + 1 : 1;
        $formatUrutan = str_pad($urutanBaru, 2, '0', STR_PAD_LEFT);

        $kodeRuang =
            $lantai->gedung->kode_gedung . '-' .
            $lantai->kode_lantai . '-' .
            $jenis->kode_jenis_ruangan . '-' .
            $formatUrutan;

        Ruang::create([
            'lantai_id'        => $lantai->id,
            'jenis_ruangan_id' => $jenis->id,
            'nama_ruang'       => $validated['nama_ruang'],
            'kode_ruang'       => $kodeRuang,
            'pic_id'           => $validated['pic_id'],
            'urutan'           => $urutanBaru,
            'is_active'        => $validated['is_active'] ?? true,
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
        $pics = Pic::where('is_active', true)->orderBy('nama_pic')->get();

        return view('ruangs.edit', compact('ruang', 'lantais', 'jenisRuangans', 'pics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruang $ruang)
    {
        $validated = $request->validate([
            'nama_ruang' => 'required|string|max:255',
            'pic_id'     => 'nullable|exists:pics,id',
            'is_active'  => 'required|boolean'
        ]);

        $ruang->update([
            'nama_ruang' => $validated['nama_ruang'],
            'pic_id'     => $validated['pic_id'],
            'is_active'  => $validated['is_active'],
        ]);

        return redirect()->route('ruangs.index')
            ->with('success', 'Ruang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruang $ruang)
    {
        // Optional: cek apakah ruangan masih dipakai di Barang
        if ($ruang->barangs()->exists()) {
            return redirect()->route('ruangs.index')
                ->with('error', 'Ruangan tidak dapat dihapus karena masih memiliki barang inventaris.');
        }
    
        $ruang->delete();

        return redirect()->route('ruangs.index')
            ->with('success', 'Ruang berhasil dihapus');
    }
}