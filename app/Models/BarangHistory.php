<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangHistory extends Model
{
    protected $fillable = [
    'barang_id',
    'is_active',
    'catatan',
    'tanggal_perubahan'
];

public function barang()
{
    return $this->belongsTo(Barang::class);
}
}
