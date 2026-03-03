<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'divisi_id',
        'ruang_id',
        'sub_jenis_barang_id',
        'pic_id',
        'kode_barang',
        'nama_barang',
        'merk',
        'serial_number',
        'tahun_perolehan',
        'keterangan',
        'urutan',
        'is_active',
        'catatan_nonaktif',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
    public function subjenis()
    {
        return $this->belongsTo(SubJenisBarang::class, 'sub_jenis_barang_id');
    }
    public function pic()
    {
        return $this->belongsTo(Pic::class);
    }
    public function histories()
    {
        return $this->hasMany(BarangHistory::class);
    }
}
