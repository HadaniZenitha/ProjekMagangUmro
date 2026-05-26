<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangSewa;
use App\Models\Ruang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // ===== TOTAL =====
        $totalSewa = BarangSewa::count();
        $totalBarang = Barang::count() + $totalSewa;

        $totalRuang = Ruang::count();

        // ===== KONDISI (DIGABUNG) =====
        $barangBaik = Barang::where('kondisi', 'Baik')->count()
            + BarangSewa::where('kondisi', 'Baik')->count();

        $barangPerbaikan = Barang::where('kondisi', 'Perlu Perbaikan')->count()
            + BarangSewa::where('kondisi', 'Perlu Perbaikan')->count();

        $barangRusak = Barang::where('kondisi', 'Rusak')->count()
            + BarangSewa::where('kondisi', 'Rusak')->count();

        // ===== DATA TERBARU (OPSIONAL: GABUNG) =====
        $barangTerbaru = Barang::with(['subjenis', 'ruang'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalSewa',
            // 'totalSemua',
            'totalRuang',
            'barangBaik',
            'barangPerbaikan',
            'barangRusak',
            'barangTerbaru'
        ));
    }
}