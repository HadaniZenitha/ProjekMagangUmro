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

        // 🔹 BARANG
        $barang = Barang::select('id', 'nama_barang', 'kode_barang', 'ruang_id')
            ->with('ruang')
            ->where(function ($query) use ($keyword) {
                $query->where('nama_barang', 'like', "%$keyword%")
                      ->orWhere('kode_barang', 'like', "%$keyword%");
            })
            ->limit(5)
            ->get();

        // 🔹 RUANG
        $ruang = Ruang::select('id', 'nama_ruang')
            ->where('nama_ruang', 'like', "%$keyword%")
            ->limit(5)
            ->get();

        // 🔹 KARYAWAN
        $karyawan = Pic::select('id', 'nama_pic')
            ->where('nama_pic', 'like', "%$keyword%")
            ->limit(5)
            ->get();

        // 🔹 GEDUNG
        $gedung = Gedung::select('id', 'nama_gedung')
            ->where('nama_gedung', 'like', "%$keyword%")
            ->limit(5)
            ->get();

        return response()->json([
            'barang'   => $barang,
            'ruang'    => $ruang,
            'karyawan' => $karyawan,
            'gedung'   => $gedung
        ]);
    }
}
