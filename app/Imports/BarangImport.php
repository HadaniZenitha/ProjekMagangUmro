<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Divisi;
use App\Models\SubJenisBarang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Abaikan baris jika kolom nama_barang (index ke-4) kosong
        if (!isset($row[4])) {
            return null;
        }

        // Cari relasi berdasarkan ID yang diinput di Excel
        $divisi = Divisi::find($row[0]);
        $subjenis = SubJenisBarang::with('jenis.kelompok')->find($row[2]);

        // Jika ID Divisi atau Sub Jenis tidak valid, jangan simpan baris ini
        if (!$divisi || !$subjenis) {
            return null;
        }

        $kelompok = $subjenis->jenis->kelompok;
        $tahun = $row[7] ?? date('Y');

        // Logika merakit Kode Barang otomatis
        $lastUrutan = Barang::where('divisi_id', $divisi->id)->max('urutan');
        $urutanBaru = $lastUrutan ? $lastUrutan + 1 : 1;
        $formatUrutan = str_pad($urutanBaru, 2, '0', STR_PAD_LEFT);

        $kodeBarang = $kelompok->kode_kelompok . '/' . 
                      $subjenis->kode_subjenis . '/' . 
                      $formatUrutan . '/' . 
                      $tahun . '/' . 
                      $divisi->kode_divisi;

        // Return data layaknya tutorial Malas Ngoding
        return new Barang([
            'divisi_id'           => $row[0], // Kolom A
            'ruang_id'            => $row[1], // Kolom B
            'sub_jenis_barang_id' => $row[2], // Kolom C
            'pic_id'              => $row[3], // Kolom D
            'nama_barang'         => $row[4], // Kolom E
            'merk'                => $row[5], // Kolom F
            'serial_number'       => $row[6], // Kolom G
            'tahun_perolehan'     => $tahun,  // Kolom H
            'keterangan'          => $row[8], // Kolom I
            'kode_barang'         => $kodeBarang,
            'urutan'              => $urutanBaru,
            'is_active'           => true,
        ]);
    }
}