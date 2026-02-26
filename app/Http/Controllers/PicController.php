<?php

namespace App\Http\Controllers;

use App\Models\Pic;
use App\Models\Divisi;
use Illuminate\Http\Request;

class PicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pics = Pic::with('divisi')->orderBy('nama_pic')->get();
        return view('pic.index', compact('pics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisis = Divisi::where('is_active', true)->get();
        return view('pic.create', compact('divisis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
            'nama_pic' => 'required',
            'nid_pic' => [
                            'required',
                            'unique:pics,nid_pic',
                            // 'regex:/^[0-9]{8}[A-Za-z]{2}$/'
                    ],
            'jabatan' => 'nullable',
            'is_active' => 'required|boolean'
        ]);

        $request->merge([
            'nid_pic' => strtoupper($request->nid_pic)
        ]);

        Pic::create($request->all());

        return redirect()->route('pic.index')
            ->with('success', 'PIC berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pic $pic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pic $pic)
    {
        $divisis = Divisi::where('is_active', true)->get();
        return view('pic.edit', compact('pic', 'divisis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pic $pic)
    {
        $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
            'nama_pic' => 'required',
            // 'nid_pic' => 'required|unique:pics,nid_pic,' . $pic->id,
            'jabatan' => 'nullable',
            'is_active' => 'required|boolean'
        ]);

        $pic->update([
                'divisi_id' => $request->divisi_id,
                'nama_pic' => $request->nama_pic,
                'jabatan' => $request->jabatan,
                'is_active' => $request->is_active,
                ]);

        return redirect()->route('pic.index')
            ->with('success', 'PIC berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pic $pic)
    {
        $pic->delete();

        return redirect()->route('pic.index')
            ->with('success', 'PIC berhasil dihapus');
    }

    public function getByDivisi($divisiId)
    {
        $pics = \App\Models\Pic::where('divisi_id', $divisiId)
                ->where('is_active', true)
                ->orderBy('nama_pic')
                ->get();
    
        return response()->json($pics);
    }
}
