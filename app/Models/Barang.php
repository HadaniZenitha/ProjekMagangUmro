<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @method static static create(array $attributes = [])
 */
class Barang extends Model
{
    protected $fillable = [
        'divisi_id',
        'ruang_id',
        'sub_jenis_barang_id',
        'pic_id',
        'kode_barang',
        'nama_barang',
        'tahun_perolehan',
        'kondisi',
        'foto',
        'urutan',
        'is_active',
        'catatan_nonaktif',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'tahun_perolehan' => 'integer',
    ];

    // ====================== RELASI ======================
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function pic()
    {
        return $this->belongsTo(Pic::class);
    }

    public function subjenis()
    {
        return $this->belongsTo(SubJenisBarang::class, 'sub_jenis_barang_id');
    }

    public function barangHistories()
    {
        return $this->hasMany(BarangHistory::class, 'barang_id')
                    ->orderBy('tanggal_perubahan', 'desc');
    }

protected static function booted()
{
    // Saat barang baru dibuat
    static::created(function (Barang $barang) {
        $barang->barangHistories()->create([
            'kondisi'           => $barang->kondisi,
            'tahun_perolehan'   => $barang->tahun_perolehan,
            'is_active'         => $barang->is_active,
            'ruang_id'          => $barang->ruang_id,
            'pic_id_baru'       => $barang->pic_id, // PIC saat ini dianggap sebagai PIC baru
            'user_id'           => Auth::id(),
            'catatan'           => 'Barang baru ditambahkan ke sistem',
            'tanggal_perubahan' => now(),
        ]);
    });

    // Saat barang diupdate
    static::updated(function (Barang $barang) {

        // Hanya jalan kalau ada perubahan penting
        if ($barang->wasChanged(['kondisi', 'is_active', 'ruang_id', 'tahun_perolehan', 'pic_id'])) {

            $changes = [];

            if ($barang->wasChanged('kondisi')) {
                $changes[] = "Kondisi: " 
                    . ($barang->getOriginal('kondisi') ?? '-') 
                    . " → " 
                    . $barang->kondisi;
            }

            if ($barang->wasChanged('pic_id')) {
                // Ambil nama PIC lama untuk catatan (opsional)
                $oldPicName = \App\Models\Pic::find($barang->getOriginal('pic_id'))->nama_pic ?? '-';
                $newPicName = $barang->pic->nama_pic ?? '-';
                $changes[] = "Pergantian PIC: $oldPicName → $newPicName";
            }

            if ($barang->wasChanged('tahun_perolehan')) {
                $changes[] = "Tahun: " 
                    . ($barang->getOriginal('tahun_perolehan') ?? '-') 
                    . " → " 
                    . $barang->tahun_perolehan;
            }

            if ($barang->wasChanged('is_active')) {
                $changes[] = "Status Aktif: " 
                    . ($barang->getOriginal('is_active') ? 'Aktif' : 'Nonaktif') 
                    . " → " 
                    . ($barang->is_active ? 'Aktif' : 'Nonaktif');
            }

            if ($barang->wasChanged('ruang_id')) {
                // Ambil nama ruang lama
                $oldRuangId = $barang->getOriginal('ruang_id');
                $oldRuangName = \App\Models\Ruang::find($oldRuangId)->nama_ruang ?? '-';
                
                // Ambil nama ruang baru (sudah ter-update di object $barang)
                $newRuangName = $barang->ruang->nama_ruang ?? '-';
                
                $changes[] = "Lokasi: $oldRuangName → $newRuangName";
            }

            // ✅ SIMPAN DATA TERBARU (SETELAH UPDATE)
            $barang->barangHistories()->create([
                'kondisi'           => $barang->kondisi,
                'tahun_perolehan'   => $barang->tahun_perolehan,
                'is_active'         => $barang->is_active,
                'ruang_id'          => $barang->ruang_id,
                'pic_id_lama'       => $barang->getOriginal('pic_id'), // PIC sebelum diubah
                'pic_id_baru'       => $barang->pic_id, // PIC setelah diubah
                'user_id'           => Auth::id(),
                'catatan'           => 'Perubahan: ' . implode(', ', $changes),
                'tanggal_perubahan' => now(),
            ]);
        }
    });
}

    public function getFotoUrlAttribute()
    {
        return $this->foto 
            ? asset('storage/' . $this->foto) 
            : asset('images/no-image.png'); // fallback image
    }
}