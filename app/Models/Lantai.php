<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;

    protected $fillable = [
        'gedung_id',
        'kode_lantai',
        'nama_lantai',
        'is_active',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    // nanti ruangan turunannya
    public function ruangs()
    {
        return $this->hasMany(Ruang::class);
    }
}
