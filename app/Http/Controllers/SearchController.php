<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Barang;
use App\Models\Ruang;
use App\Models\Pic;
use App\Models\Gedung;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->q;

        $barang = Barang::select(
                'id',
                'nama_barang',
                'kode_barang',
                'ruang_id',
                DB::raw('COUNT(*) as total')
            )
            ->with('ruang')
            ->where(function ($query) use ($keyword) {
                $query->where('nama_barang', 'like', "%{$keyword}%")
                    ->orWhere('kode_barang', 'like', "%{$keyword}%");
            })
            ->groupBy('id', 'nama_barang', 'kode_barang', 'ruang_id')
            ->limit(5)
            ->get();

        $ruang = Ruang::select(
                'id',
                'nama_ruang'
            )
            ->where('nama_ruang', 'like', "%{$keyword}%")
            ->limit(5)
            ->get();

        $karyawan = Pic::select(
                'id',
                'nama_pic'
            )
            ->where('nama_pic', 'like', "%{$keyword}%")
            ->limit(5)
            ->get();

        $gedung = Gedung::select(
                'id',
                'nama_gedung'
            )
            ->where('nama_gedung', 'like', "%{$keyword}%")
            ->limit(5)
            ->get();

        return response()->json([
            'barang' => $barang,
            'ruang' => $ruang,
            'karyawan' => $karyawan,
            'gedung' => $gedung
        ]);
    }
}