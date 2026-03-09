<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruang;
use App\Models\BarangRusak;
use App\Models\PerluPerbaikan;
use App\Models\Kondisi;
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
        $totalBarangRusak = BarangRusak::count();
        $totalPerluPerbaikan = PerluPerbaikan::count();
        $totalKondisi = Kondisi::count();
        $totalBarangBaik = Barang::where('keterangan', 'Baik')->count();

        $barangTerbaru = Barang::with('divisi', 'ruang', 'pic')
                        ->orderByDesc('id')
                        ->take(5)
                        ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalRuang',
            'totalBarangRusak',
            'totalPerluPerbaikan',
            'totalKondisi',
            'totalBarangBaik',
            'barangTerbaru'
        ));
    }
}