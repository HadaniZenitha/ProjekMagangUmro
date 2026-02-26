<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class KelompokBarang extends Model
{
    protected $fillable = [
        'kode_kelompok',
        'nama_kelompok',
        'deskripsi',
        'urutan',
        'is_active'
    ];
    protected function nama_kelompok(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value),
        );
    }

    public function jenisBarangs()
    {
    return $this->hasMany(JenisBarang::class);
    }
}   
