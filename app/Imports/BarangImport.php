<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Pic;
use App\Models\Ruang;
use App\Models\SubJenisBarang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    public $successCount = 0;
    public $failedRows = [];
    private $currentRow = 1;

    public function model(array $row)
    {
        $this->currentRow++;

        // Mapping berdasarkan header file export: Kode, Nama, Divisi, PIC, Ruang, Tahun, Status, Catatan
        $kodeBarang = trim($row['kode'] ?? '');
        $namaBarang = trim($row['nama'] ?? '');
        $namaPic    = trim($row['pic'] ?? '');
        $tahun      = trim($row['tahun'] ?? '');
        $kondisi    = trim($row['kondisi'] ?? 'Baik');
        $status     = trim($row['status'] ?? 'Aktif');
        $catatan    = trim($row['catatan'] ?? '');

        // Skip jika baris kosong
        if (empty($kodeBarang) && empty($namaBarang)) {
            return null;
        }

        // 1. Parsing Kode Barang untuk mendapatkan Subjenis dan Nama Ruang
        // Format: 02/200.02/01/2022/Ruang IT
        $parts = preg_split('/\s*\/\s*/', $kodeBarang);
        if (count($parts) < 5) {
            $this->addFailedRow($namaBarang, "Format kode tidak valid (Harus: Kelompok/Subjenis/Urutan/Tahun/Ruang)");
            return null;
        }

        $kodeSubjenis = trim($parts[1]);
        $urutan       = (int) trim($parts[2]);
        $tahunPart    = (int) trim($parts[3]);
        $namaRuang    = trim($parts[4]);

        // 2. Lookup Database
        $subjenis = SubJenisBarang::where('kode_subjenis', $kodeSubjenis)->first();
        $pic      = Pic::whereRaw('LOWER(nama_pic) = ?', [strtolower($namaPic)])->first();
        $ruang    = Ruang::whereRaw('LOWER(nama_ruang) = ?', [strtolower($namaRuang)])->first();

        // 3. Validasi
        if (!$subjenis || !$pic || !$ruang) {
            $err = [];
            if (!$subjenis) $err[] = "Subjenis '$kodeSubjenis' tidak ada";
            if (!$pic)      $err[] = "PIC '$namaPic' tidak ada";
            if (!$ruang)    $err[] = "Ruang '$namaRuang' tidak ada";
            
            $this->addFailedRow($namaBarang, implode(', ', $err));
            return null;
        }

        // 4. Cek Duplikat Kode Barang
        if (Barang::where('kode_barang', $kodeBarang)->exists()) {
            $this->addFailedRow($namaBarang, "Kode barang sudah terdaftar");
            return null;
        }

        $this->successCount++;

        return new Barang([
            'kode_barang'         => $kodeBarang,
            'nama_barang'         => $namaBarang,
            'divisi_id'           => $pic->divisi_id,
            'pic_id'              => $pic->id,
            'ruang_id'            => $ruang->id,
            'sub_jenis_barang_id' => $subjenis->id,
            'tahun_perolehan'     => $tahun ?: $tahunPart,
            'urutan'              => $urutan,
            'kondisi'             => $kondisi, 
            'is_active'           => (strtolower($status) === 'nonaktif') ? false : true,
            'catatan_nonaktif'    => $catatan ?: null,
        ]);
    }

    private function addFailedRow($nama, $reason)
    {
        $this->failedRows[] = [
            'row' => $this->currentRow,
            'nama_barang' => $nama ?: 'N/A',
            'reason' => $reason
        ];
    }

    public function getSuccessCount() { return $this->successCount; }
    public function getFailedRows() { return $this->failedRows; }
    public function getFailedCount() { return count($this->failedRows); }
}