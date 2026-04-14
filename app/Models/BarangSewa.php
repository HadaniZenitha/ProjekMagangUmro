<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangSewa extends Model
{
    protected $table = 'barang_sewa';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'fungsi', // ✅ UBAH dari fungsi
        'pic_id',
        'ruang_id',
        'tahun',
        'kondisi',
    ];

    // =====================
    // RELASI
    // =====================

    public function pic()
    {
        return $this->belongsTo(Pic::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    // ✅ RELASI FUNGSI (DIVISI/BIDANG)
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'fungsi_id');
    }
}