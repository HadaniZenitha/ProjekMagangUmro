<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $fillable = [
        'divisi_id',
        'nama_pic',
        'nid_pic',
        'jabatan',
        'is_active'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
