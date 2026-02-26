<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Ruang;
use App\Models\Gedung;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalBarang = Barang::count();
        $totalRuang = Ruang::count();
        $totalGedung = Gedung::count();

        $barangTerbaru = Barang::with(['ruang', 'subjenis'])->latest()->take(5)->get();
    
        return view('dashboard', compact('totalBarang', 'totalRuang', 'totalGedung', 'barangTerbaru'));
    }
}
