<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubJenisBarang extends Model
{
    protected $fillable = [
        'jenis_barang_id',
        'kode_subjenis',
        'nama_subjenis',
        'deskripsi',
        'urutan',
        'is_active'
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

}
