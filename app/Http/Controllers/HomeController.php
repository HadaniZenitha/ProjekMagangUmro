<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruang;
<<<<<<< HEAD
use App\Models\BarangRusak;
use App\Models\PerluPerbaikan;
use App\Models\Kondisi;
=======
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
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
<<<<<<< HEAD
        $totalBarangRusak = BarangRusak::count();
        $totalPerluPerbaikan = PerluPerbaikan::count();
        $totalKondisi = Kondisi::count();
        $totalBarangBaik = Barang::where('keterangan', 'Baik')->count();

        $barangTerbaru = Barang::with('divisi', 'ruang', 'pic')
                        ->orderByDesc('id')
                        ->take(5)
                        ->get();
=======

        $barangBaik = Barang::where('kondisi','baik')->count();

        $barangPerbaikan = Barang::where('kondisi','perlu_perbaikan')->count();

        $barangRusak = Barang::where('kondisi','rusak')->count();

        $barangTerbaru = Barang::with(['subjenis','ruang'])
            ->latest()
            ->take(5)
            ->get();
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf

        return view('dashboard', compact(
            'totalBarang',
            'totalRuang',
<<<<<<< HEAD
            'totalBarangRusak',
            'totalPerluPerbaikan',
            'totalKondisi',
            'totalBarangBaik',
=======
            'barangBaik',
            'barangPerbaikan',
            'barangRusak',
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
            'barangTerbaru'
        ));
    }
}