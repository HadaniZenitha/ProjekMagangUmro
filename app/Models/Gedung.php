<?php

namespace App\Models;

use App\Models\Lantai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_gedung',
        'nama_gedung',
        'is_active',
    ];

    // relasi nanti:
    public function lantais()
    {
        return $this->hasMany(Lantai::class);
    }
}
