<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $fillable = [
        'lantai_id',
        'jenis_ruangan_id',
        'kode_ruang',
        'nama_ruang',
        'pic_nama',
        'urutan',
        'is_active'
    ];

    public function lantai()
    {
        return $this->belongsTo(Lantai::class);
    }


    public function jenisRuangan()
    {
        return $this->belongsTo(JenisRuangan::class);
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
