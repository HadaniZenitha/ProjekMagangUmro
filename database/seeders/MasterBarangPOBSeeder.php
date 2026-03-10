<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KelompokBarang;
use App\Models\JenisBarang;
use App\Models\SubJenisBarang;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MasterBarangPOBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $path = storage_path('app/pob/POB Inventaris.xlsx');

        if (!file_exists($path)) {
            $this->command->error("File Excel tidak ditemukan: " . $path);
            return;
        }

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $kelompokId = null;
        $jenisId = null;

        foreach ($rows as $index => $row) {

            $text = trim($row[0] ?? '');

            if (!$text) {
                continue;
            }

            /*
            -----------------------------
            DETEKSI KELOMPOK
            contoh:
            01 - ALAT TULIS
            -----------------------------
            */

            if (preg_match('/^(\d{2})\s*-\s*(.+)$/', $text, $match)) {

                $kode = $match[1];
                $nama = trim($match[2]);

                $kelompok = KelompokBarang::firstOrCreate([
                    'kode_kelompok' => $kode
                ],[
                    'nama_kelompok' => $nama,
                    'urutan' => $kode
                ]);

                $kelompokId = $kelompok->id;
                $jenisId = null;

                continue;
            }

            /*
            -----------------------------
            DETEKSI JENIS
            contoh:
            100 - MEJA
            -----------------------------
            */

            if (preg_match('/^(\d{3})\s*-\s*(.+)$/', $text, $match)) {

                if (!$kelompokId) {
                    continue;
                }

                $kode = $match[1];
                $nama = trim($match[2]);

                $jenis = JenisBarang::firstOrCreate([
                    'kode_jenis' => $kode
                ],[
                    'kelompok_barang_id' => $kelompokId,
                    'nama_jenis' => $nama,
                    'urutan' => $kode
                ]);

                $jenisId = $jenis->id;

                continue;
            }

            /*
            -----------------------------
            DETEKSI SUB JENIS
            contoh:
            100.01 - MEJA TULIS
            -----------------------------
            */

            if (preg_match('/^(\d{3}\.\d{2})\s*-\s*(.+)$/', $text, $match)) {

                if (!$jenisId) {
                    continue;
                }

                $kode = $match[1];
                $nama = trim($match[2]);

                SubJenisBarang::firstOrCreate([
                    'kode_subjenis' => $kode
                ],[
                    'jenis_barang_id' => $jenisId,
                    'nama_subjenis' => $nama
                ]);
            }
        }

        $this->command->info("Seeder Master Barang dari Excel selesai.");
    }
}
