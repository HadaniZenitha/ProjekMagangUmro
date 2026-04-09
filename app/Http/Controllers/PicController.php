<?php

namespace App\Http\Controllers;

use App\Imports\PicImport;
use App\Models\Pic;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class PicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $pics = Pic::with('divisi')
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('nama_pic', 'like', "%{$search}%")
                            ->orWhere('nid_pic', 'like', "%{$search}%")
                            ->orWhere('jabatan_lengkap', 'like', "%{$search}%")
                            ->orWhereHas('divisi', function ($divisiQuery) use ($search) {
                                $divisiQuery->where('nama_divisi', 'like', "%{$search}%");
                            });
                    });
                })
                ->orderBy('nama_pic')
                ->paginate(15)
                ->withQueryString();

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
            'jabatan_lengkap' => 'nullable|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        $validated['nid_pic'] = strtoupper($validated['nid_pic']);
        $validated['jabatan'] = Divisi::where('id', $validated['divisi_id'])->value('nama_divisi');

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
            'jabatan_lengkap' => 'nullable|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        $validated['nid_pic'] = strtoupper($validated['nid_pic']);
        $validated['jabatan'] = Divisi::where('id', $validated['divisi_id'])->value('nama_divisi');
        
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

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv',
        ]);

        $import = new PicImport;
        Excel::import($import, $request->file('file_excel'));

        $createdCount = $import->getCreatedCount();
        $updatedCount = $import->getUpdatedCount();
        $failedCount = $import->getFailedCount();
        $failedRows = $import->getFailedRows();

        $message = "Import selesai: {$createdCount} PIC ditambahkan, {$updatedCount} PIC diperbarui";

        if ($failedCount > 0) {
            $message .= ", {$failedCount} baris gagal.";
            session()->flash('import_errors', $failedRows);
            session()->flash('warning', $message);
        } else {
            session()->flash('success', $message);
        }

        return redirect()->route('pic.index');
    }
}