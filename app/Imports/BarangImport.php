<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Pic;
use App\Models\Ruang;
use App\Models\SubJenisBarang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    public $successCount = 0;
    public $failedRows = [];
    private $currentRow = 0;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $this->currentRow++;

        // Gunakan posisi kolom agar tidak bergantung pada nama header.
        // Format 4 kolom: [nama_barang, nomor_barang, kondisi, nama_pic]
        $values = array_values($row);
        $namaBarang = trim((string) ($values[0] ?? ''));
        $nomorBarang = trim((string) ($values[1] ?? ''));
        $kondisi = trim((string) ($values[2] ?? ''));
        $namaPic = trim((string) ($values[3] ?? ''));

        // Jika file masih menyertakan header, skip baris header tanpa dianggap gagal.
        if (
            in_array(strtolower($namaBarang), ['nama barang', 'nama_barang'], true) &&
            in_array(strtolower($nomorBarang), ['nomor barang', 'nomor_barang'], true)
        ) {
            return null;
        }

        // Abaikan baris kosong/tidak valid minimum
        if ($namaBarang === '' || $nomorBarang === '' || $namaPic === '') {
            if ($namaBarang !== '' || $nomorBarang !== '' || $namaPic !== '') {
                $this->failedRows[] = [
                    'row' => $this->currentRow,
                    'nama_barang' => $namaBarang ?: '-',
                    'reason' => 'Kolom wajib tidak lengkap (nama_barang, nomor_barang, atau nama_pic kosong)'
                ];
            }
            return null;
        }

        // Format: kelompok/subjenis/urutan/tahun/nama ruang
        $parts = preg_split('/\s*\/\s*/', $nomorBarang);
        if (count($parts) < 5) {
            $this->failedRows[] = [
                'row' => $this->currentRow,
                'nama_barang' => $namaBarang,
                'reason' => "Format nomor_barang tidak valid: '{$nomorBarang}'. Harus: kelompok/subjenis/urutan/tahun/nama_ruang"
            ];
            return null;
        }

        $kodeSubjenis = trim($parts[1]);
        $urutanDariKode = (int) trim($parts[2]);
        $tahun = (int) trim($parts[3]);
        $namaRuang = trim($parts[4]);

        $subjenis = SubJenisBarang::with('jenis.kelompok')
            ->where('kode_subjenis', $kodeSubjenis)
            ->first();
        
        // Cari PIC berdasarkan nama (case-insensitive)
        $pic = Pic::whereRaw('LOWER(nama_pic) = ?', [strtolower($namaPic)])->first();

        // Ruang ditentukan dari segmen terakhir nomor_barang
        $ruang = $namaRuang !== ''
            ? Ruang::whereRaw('LOWER(nama_ruang) = ?', [strtolower($namaRuang)])->first()
            : null;

        // Jika FK wajib tidak valid, jangan simpan baris ini
        if (!$ruang || !$subjenis || !$pic) {
            $reasons = [];
            if (!$subjenis) $reasons[] = "Sub Jenis dengan kode '{$kodeSubjenis}' tidak ditemukan";
            if (!$pic) $reasons[] = "PIC dengan nama '{$namaPic}' tidak ditemukan di database";
            if (!$ruang) $reasons[] = "Ruang dengan nama '{$namaRuang}' tidak ditemukan";
            
            $this->failedRows[] = [
                'row' => $this->currentRow,
                'nama_barang' => $namaBarang,
                'reason' => implode('; ', $reasons)
            ];
            return null;
        }

        $divisiId = $pic->divisi_id;
        $urutan = $urutanDariKode > 0
            ? $urutanDariKode
            : ((Barang::where('divisi_id', $divisiId)->max('urutan') ?? 0) + 1);

        // Simpan nomor barang dari Excel agar format sesuai file import
        $kodeBarang = $nomorBarang;

        // Cek apakah kode_barang sudah ada (unique constraint)
        $exists = Barang::where('kode_barang', $kodeBarang)->exists();
        if ($exists) {
            $this->failedRows[] = [
                'row' => $this->currentRow,
                'nama_barang' => $namaBarang,
                'reason' => "Kode barang '{$kodeBarang}' sudah ada di database (duplikat)"
            ];
            return null;
        }

        // Prioritaskan kolom kondisi. Tetap dukung file lama yang masih pakai keterangan.
        $kondisiValue = $kondisi !== '' ? $kondisi : trim((string) ($row['keterangan'] ?? ''));

        $this->successCount++;
        
        return new Barang([
            'divisi_id'           => $divisiId,
            'ruang_id'            => $ruang->id,
            'sub_jenis_barang_id' => $subjenis->id,
            'pic_id'              => $pic->id,
            'nama_barang'         => $namaBarang,
            'merk'                => null,
            'serial_number'       => null,
            'tahun_perolehan'     => $tahun > 0 ? $tahun : null,
            'kondisi'             => $kondisiValue !== '' ? $kondisiValue : null,
            'kode_barang'         => $kodeBarang,
            'urutan'              => $urutan,
            'is_active'           => true,
        ]);
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getFailedRows()
    {
        return $this->failedRows;
    }

    public function getFailedCount()
    {
        return count($this->failedRows);
    }
}