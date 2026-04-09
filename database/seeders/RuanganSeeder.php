<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruang;
use App\Models\Lantai;
use App\Models\JenisRuangan;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan data lantai dan jenis_ruangan sudah ada sebelumnya
        $lantai1 = Lantai::find(1);   // sesuaikan ID lantai yang ada
        $jenisKerja = JenisRuangan::where('kode_jenis_ruangan', 'RK') // contoh kode jenis ruang kerja
                        ->orWhere('nama_jenis_ruangan', 'like', '%kerja%')
                        ->first();

        if (!$lantai1 || !$jenisKerja) {
            $this->command->info('Data Lantai atau Jenis Ruangan belum ada. Jalankan seeder lain terlebih dahulu.');
            return;
        }

        $dataRuang = [
            [
                'lantai_id' => 1,
                'jenis_ruangan_id' => 1,        // Ruang Kerja
                'nama_ruang' => 'Ruang IT',
                'is_active' => true,
            ],
            [
                'lantai_id' => 1,
                'jenis_ruangan_id' => 1,
                'nama_ruang' => 'Ruang Meeting',
                'is_active' => true,
            ],
            [
                'lantai_id' => 1,
                'jenis_ruangan_id' => 2,        // contoh jenis lain
                'nama_ruang' => 'Ruang Server',
                'is_active' => true,
            ],
            // tambahkan data lain sesuai kebutuhan
        ];

        foreach ($dataRuang as $item) {
            $lantai = Lantai::with('gedung')->findOrFail($item['lantai_id']);
            $jenis  = JenisRuangan::findOrFail($item['jenis_ruangan_id']);

            // Logic generate kode_ruang sama persis dengan Controller
            $lastUrutan = Ruang::where('lantai_id', $lantai->id)
                ->where('jenis_ruangan_id', $jenis->id)
                ->max('urutan');

            $urutanBaru = $lastUrutan ? $lastUrutan + 1 : 1;
            $formatUrutan = str_pad($urutanBaru, 2, '0', STR_PAD_LEFT);

            $kodeRuang = 
                $lantai->gedung->kode_gedung . '-' .
                $lantai->kode_lantai . '-' .
                $jenis->kode_jenis_ruangan . '-' .
                $formatUrutan;

            Ruang::create([
                'lantai_id'         => $item['lantai_id'],
                'jenis_ruangan_id'  => $item['jenis_ruangan_id'],
                'nama_ruang'        => $item['nama_ruang'],
                'kode_ruang'        => $kodeRuang,
                'urutan'            => $urutanBaru,
                'is_active'         => $item['is_active'] ?? true,
            ]);
        }

        $this->command->info('Ruang berhasil di-seed dengan kode ruang otomatis!');
    }
}