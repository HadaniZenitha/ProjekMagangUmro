<?php

namespace App\Http\Controllers;

use App\Models\Pic;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pics = Pic::with('divisi')
                ->orderBy('nama_pic')
                ->paginate(15);

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
        $validated = $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
            'nama_pic' => 'required|string|max:255',
            'nid_pic' => [
                'required',
                'string',
                'size:10',
                'unique:pics,nid_pic',
            ],
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'is_active' => 'required|boolean',
        ], [
            'nid_pic.regex' => 'Pastikan NID PIC sudah sesuai dan tidak lebih dari 10 karakter.',
        ]);

        $validated['nid_pic'] = strtoupper($validated['nid_pic']);
        $validated['jabatan'] = strtoupper($validated['jabatan']);

        Pic::create($validated);

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
        $validated = $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
            'nama_pic' => 'required|string|max:255',
            'nid_pic'   => [
                'required',
                'string',
                'max:10',
                \Illuminate\Validation\Rule::unique('pics')->ignore($pic->id),
            ],
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'is_active' => 'required|boolean'
        ]);

        $validated['nid_pic'] = strtoupper($validated['nid_pic']);
        $validated['jabatan'] = strtoupper($validated['jabatan']);
        
        $pic->update($validated);

        return redirect()->route('pic.index')
            ->with('success', 'PIC berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pic $pic)
    {
        // Cek apakah PIC masih digunakan
        if ($pic->barangs()->exists() || $pic->ruangans()->exists()) {
            return redirect()->route('pic.index')
                ->with('error', 'PIC tidak dapat dihapus karena masih digunakan di ruangan atau barang.');
        }

        $pic->delete();

        return redirect()->route('pic.index')
            ->with('success', 'PIC berhasil dihapus.');
    }

    public function getByDivisi($divisiId)
    {
        $pics = Pic::where('divisi_id', $divisiId)
                ->where('is_active', true)
                ->orderBy('nama_pic')
                ->select('id', 'nama_pic', 'jabatan')
                ->get();

        return response()->json($pics);
    }
}