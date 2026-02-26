<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_jenis_ruangan',
        'nama_jenis_ruangan',
        'is_active',
    ];

    public function ruangs()
    {
        return $this->hasMany(Ruang::class);
    }
}
