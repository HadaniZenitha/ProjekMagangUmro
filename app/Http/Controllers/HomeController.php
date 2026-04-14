<?php

namespace App\Http\Controllers;

use App\Models\Barang;
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
        // TOTAL DATA
        $totalBarang = Barang::count();
        $totalRuang = Ruang::count();

        // AMBIL DATA BERDASARKAN KONDISI (AMAN & CLEAN)
        $barangBaik = Barang::where('kondisi', 'Baik')->count();

        $barangPerbaikan = Barang::where('kondisi', 'Perlu Perbaikan')->count();

        $barangRusak = Barang::where('kondisi', 'Rusak')->count();

        // DATA TERBARU
        $barangTerbaru = Barang::with(['subjenis', 'ruang'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalRuang',
            'barangBaik',
            'barangPerbaikan',
            'barangRusak',
            'barangTerbaru'
        ));
    }
}