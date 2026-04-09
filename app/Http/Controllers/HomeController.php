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
        $totalBarang = Barang::count();
        $totalRuang = Ruang::count();

        $barangBaik = Barang::where('kondisi','Layak')->count();

        $barangPerbaikan = Barang::where('kondisi','perlu perbaikan')->count();

        $barangRusak = Barang::where('kondisi','rusak')->count();

        $barangTerbaru = Barang::with(['subjenis','ruang'])
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
