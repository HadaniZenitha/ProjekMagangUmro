<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    protected $fillable = [
        'kelompok_barang_id',
        'kode_jenis',
        'nama_jenis',
        'deskripsi',
        'urutan',
        'is_active'
    ];

    public function kelompok()
    {
        return $this->belongsTo(KelompokBarang::class, 'kelompok_barang_id');
    }

    public function subJenisBarangs()
    {
    return $this->hasMany(SubJenisBarang::class);
    }
}
