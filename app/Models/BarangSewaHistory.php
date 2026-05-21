<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangSewaHistory extends Model
{
    use HasFactory;

    protected $table = 'barang_sewa_histories';

    protected $fillable = [
        'barang_sewa_id',
        'pic_id_lama',
        'pic_id_baru',
        'kondisi',
        'catatan',
        'tanggal_perubahan',
        'user_id',
    ];

    protected $casts = [
        'tanggal_perubahan' => 'datetime',
    ];

    /* ================= RELASI ================= */

    // ke barang sewa
    public function barangSewa()
    {
        return $this->belongsTo(BarangSewa::class);
    }

    // PIC lama
    public function picLama()
    {
        return $this->belongsTo(Pic::class, 'pic_id_lama');
    }

    // PIC baru
    public function picBaru()
    {
        return $this->belongsTo(Pic::class, 'pic_id_baru');
    }

    // user/admin
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}