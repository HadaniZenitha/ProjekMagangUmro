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
        // 'merk',
        // 'serial_number',
        'tahun_perolehan',
        'kondisi',
        'urutan',
        'is_active',
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
    public function barangHistories()
    {
        return $this->hasMany(BarangHistory::class, 'barang_id')
                    ->orderBy('tanggal_perubahan', 'desc');
    }
    // Di dalam class Barang
    protected static function booted()
    {
        static::created(function (Barang $barang) {
            $barang->barangHistories()->create([
                'kondisi'           => $barang->kondisi,
                'is_active'         => $barang->is_active,
                'catatan'           => 'Barang baru ditambahkan',
                'tanggal_perubahan' => now(),
            ]);
        });

        static::updated(function (Barang $barang) {
            // Hanya simpan history jika kondisi atau status aktif berubah
            if ($barang->isDirty('kondisi') || $barang->isDirty('is_active')) {
                $barang->barangHistories()->create([
                    'kondisi'           => $barang->kondisi,
                    'is_active'         => $barang->is_active,
                    'catatan'           => 'Perubahan data barang',
                    'tanggal_perubahan' => now(),
                ]);
            }
        });
    }
}
