<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangHistory extends Model
{
    protected $fillable = [
    'barang_id',
    'kondisi',
    'is_active',
    'catatan',
    'tanggal_perubahan'
];

    protected $casts = [
        'is_active' => 'boolean',
        'tanggal_perubahan' => 'datetime',
    ];

public function barang()
{
    return $this->belongsTo(Barang::class);
}
}
