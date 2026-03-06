<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Ruang;
use App\Models\Pic;
use App\Models\Gedung;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->q;

        $barang = Barang::where('nama_barang','like',"%$keyword%")
                ->orWhere('kode_barang','like',"%$keyword%")
                ->limit(5)
                ->get();

        $ruang = Ruang::where('nama_ruang','like',"%$keyword%")
                ->limit(5)
                ->get();

        $karyawan = Pic::where('nama_pic','like',"%$keyword%")
                ->limit(5)
                ->get();

        $gedung = Gedung::where('nama_gedung','like',"%$keyword%")
                ->limit(5)
                ->get();

        return response()->json([
            'barang'=>$barang,
            'ruang'=>$ruang,
            'karyawan'=>$karyawan,
            'gedung'=>$gedung
        ]);
    }
}