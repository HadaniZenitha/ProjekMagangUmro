<?php

namespace App\Http\Controllers;

use App\Imports\PicImport;
use App\Models\Pic;
use App\Models\Divisi;
use Illuminate\Http\Request;
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
                ->paginate(10)
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
        $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
            'nama_pic' => 'required',
            'nid_pic' => [
                'required',
                'unique:pics,nid_pic',
            ],
            'jabatan' => 'nullable',
            'jabatan_lengkap' => 'nullable|string|max:255',
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
            'jabatan' => 'nullable',
            'jabatan_lengkap' => 'nullable|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        $pic->update([
            'divisi_id' => $request->divisi_id,
            'nama_pic' => $request->nama_pic,
            'jabatan' => $request->jabatan,
            'jabatan_lengkap' => $request->jabatan_lengkap,
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
        $pics = Pic::where('divisi_id', $divisiId)
                ->where('is_active', true)
                ->orderBy('nama_pic')
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