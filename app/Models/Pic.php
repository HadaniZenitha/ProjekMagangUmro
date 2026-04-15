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
        'jabatan_lengkap',
        'is_active'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function ruangans()
    {
        return $this->hasMany(Ruang::class); 
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    // Melihat riwayat di mana orang ini menjadi PIC LAMA (Barang keluar dari tanggung jawabnya)
    public function riwayatLepasBarang()
    {
        return $this->hasMany(BarangHistory::class, 'pic_id_lama');
    }

    // Melihat riwayat di mana orang ini menjadi PIC BARU (Barang masuk ke tanggung jawabnya)
    public function riwayatTerimaBarang()
    {
        return $this->hasMany(BarangHistory::class, 'pic_id_baru');
    }
}
