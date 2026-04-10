<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class BarangHistory extends Model
{
    protected $table = 'barang_histories';

    protected $fillable = [
        'barang_id',
        'ruang_id',
        'user_id',
        'kondisi',
        'tahun_perolehan',
        'is_active',
        'catatan',
        'tanggal_perubahan',
    ];

    protected $casts = [
        'is_active'         => 'boolean',
        'tahun_perolehan'   => 'integer',
        'tanggal_perubahan' => 'datetime',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk mengambil history dalam rentang tahun tertentu
     */
    public function scopeInYear($query, $year)
    {
        return $query->whereYear('tanggal_perubahan', $year);
    }

    /**
     * Scope untuk mengurutkan dari yang paling baru
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('tanggal_perubahan', 'desc');
    }
}
