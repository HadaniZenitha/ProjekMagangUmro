<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerluPerbaikan extends Model
{
    use HasFactory;

    protected $table = 'perlu_perbaikans';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'ruang',
        'keterangan'
    ];
}