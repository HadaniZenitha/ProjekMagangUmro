<?php

namespace App\Http\Controllers;

use App\Models\BarangSewa;
use App\Models\Divisi;
use App\Models\Ruang;
use App\Models\Pic;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangSewaExport;

class SewaController extends Controller
{

    public function index(Request $request)
    {
        $query = BarangSewa::with(['divisi', 'pic', 'ruang'])->latest();

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER DIVISI
        if ($request->divisi) {
            $query->where('divisi_id', $request->divisi);
        }

        // FILTER PIC
        if ($request->pic) {
            $query->where('pic_id', $request->pic);
        }

        // FILTER RUANG
        if ($request->ruang) {
            $query->where('ruang_id', $request->ruang);
        }

        // FILTER TAHUN
        if ($request->tahun_awal && $request->tahun_akhir) {
            $query->whereBetween('tahun', [
                $request->tahun_awal,
                $request->tahun_akhir
            ]);
        }

        $data = $query->paginate(15)->withQueryString();

        $divisis = Divisi::where('is_active', true)->orderBy('nama_divisi')->get();
        $pics = Pic::where('is_active', true)->orderBy('nama_pic')->get();
        $ruangs = Ruang::where('is_active', true)->orderBy('nama_ruang')->get();

        return view('sewa.index', compact('data', 'divisis', 'pics', 'ruangs'));
    }

    public function create()
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $divisis = Divisi::where('is_active', true)->orderBy('nama_divisi')->get();
        $ruangs = Ruang::where('is_active', true)->get();
        $pics = Pic::where('is_active', true)->get();

        return view('sewa.create', compact('divisis', 'ruangs', 'pics'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $request->validate([
            'kode_barang' => 'required|unique:barang_sewa,kode_barang',
            'nama_barang' => 'required',
            'divisi_id'   => 'required|exists:divisis,id',
            'pic_id'      => 'required|exists:pics,id',
            'ruang_id'    => 'required|exists:ruangs,id',
            'tahun'       => 'required|numeric',
            'kondisi'     => 'required'
        ]);

        BarangSewa::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'divisi_id'   => $request->divisi_id,
            'pic_id'      => $request->pic_id,
            'ruang_id'    => $request->ruang_id,
            'tahun'       => $request->tahun,
            'kondisi'     => $request->kondisi,
        ]);

        return redirect()->route('barang-sewa.index')
            ->with('success', 'Barang sewa berhasil ditambahkan');
    }

    public function edit(BarangSewa $sewa)
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $divisis = Divisi::where('is_active', true)->orderBy('nama_divisi')->get();
        $ruangs = Ruang::where('is_active', true)->get();

        $pics = Pic::where('divisi_id', $sewa->divisi_id)
            ->where('is_active', true)
            ->orderBy('nama_pic')
            ->get();

        return view('sewa.edit', compact('sewa', 'divisis', 'pics', 'ruangs'));
    }

    public function show(BarangSewa $sewa)
    {
        $sewa->load(['divisi', 'pic', 'ruang']);
        return view('sewa.show', compact('sewa'));
    }

    public function update(Request $request, BarangSewa $sewa)
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $request->validate([
            'nama_barang' => 'required',
            'divisi_id'   => 'required|exists:divisis,id',
            'pic_id'      => 'required|exists:pics,id',
            'ruang_id'    => 'required|exists:ruangs,id',
            'tahun'       => 'required|numeric',
            'kondisi'     => 'required'
        ]);

        $sewa->update([
            'nama_barang' => $request->nama_barang,
            'divisi_id'   => $request->divisi_id,
            'pic_id'      => $request->pic_id,
            'ruang_id'    => $request->ruang_id,
            'tahun'       => $request->tahun,
            'kondisi'     => $request->kondisi,
        ]);

        return redirect()->route('barang-sewa.index')
            ->with('success', 'Barang sewa berhasil diupdate');
    }

    public function destroy(BarangSewa $sewa)
    {
        if (auth()->user()->hasRole('user')) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
        }

        $sewa->delete();

        return redirect()->route('barang-sewa.index')
            ->with('success', 'Barang sewa berhasil dihapus');
    }

    /* =========================
       🔥 EXPORT SECTION
    ========================== */

    private function buildFilterQuery(Request $request)
    {
        $query = BarangSewa::with(['divisi', 'pic', 'ruang']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->divisi) {
            $query->where('divisi_id', $request->divisi);
        }

        if ($request->pic) {
            $query->where('pic_id', $request->pic);
        }

        if ($request->ruang) {
            $query->where('ruang_id', $request->ruang);
        }

        if ($request->tahun_awal && $request->tahun_akhir) {
            $query->whereBetween('tahun', [
                $request->tahun_awal,
                $request->tahun_akhir
            ]);
        }

        return $query;
    }

    public function exportPreview(Request $request)
    {
        $data = $this->buildFilterQuery($request)->get();
        return view('sewa.export-preview', compact('data'));
    }

    public function exportPdf(Request $request)
    {
        $data = $this->buildFilterQuery($request)->get();

        $pdf = Pdf::loadView('sewa.export-pdf', [
            'data' => $data,
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-item-sewa.pdf');
    }

    public function exportExcel(Request $request)
    {
        $data = $this->buildFilterQuery($request)->get();

        return Excel::download(
            new BarangSewaExport($data),
            'item-sewa.xlsx'
        );
    }
}