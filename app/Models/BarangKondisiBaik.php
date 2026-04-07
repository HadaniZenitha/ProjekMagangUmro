<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKondisiBaik extends Model
{
    use HasFactory;

    protected $table = 'barang_kondisi_baiks';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'ruang',
        'keterangan'
    ];
}