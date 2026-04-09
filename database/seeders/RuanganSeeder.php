<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruang;
use App\Models\Lantai;
use App\Models\JenisRuangan;
use App\Models\Pic;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan dependency sudah ada
        $lantai1 = Lantai::find(1);
        $jenisKerja = JenisRuangan::where('kode_jenis_ruangan', 'RK')
                        ->orWhere('nama_jenis_ruangan', 'like', '%kerja%')
                        ->first();

        // Cari PIC default (misalnya PIC IT atau PIC Ruangan Umum)
        $picDefault = Pic::where('nama_pic', 'like', '%IT%')
                        ->orWhere('nama_pic', 'like', '%admin%')
                        ->first();

        if (!$lantai1 || !$jenisKerja) {
            $this->command->error('Data Lantai atau Jenis Ruangan belum ada. Jalankan seeder lain terlebih dahulu.');
            return;
        }

        if (!$picDefault) {
            $this->command->warn('PIC default tidak ditemukan. Pastikan PicSeeder dijalankan sebelumnya.');
            // Bisa tetap lanjut dengan pic_id = null, atau buat PIC dummy di sini
        }

        $dataRuang = [
            [
                'lantai_id'         => 1,
                'jenis_ruangan_id'  => 1,        // Ruang Kerja
                'nama_ruang'        => 'Ruang IT',
                'is_active'         => true,
                'pic_id'            => $picDefault?->id ?? null,   // ← Tambahkan
            ],
            [
                'lantai_id'         => 1,
                'jenis_ruangan_id'  => 1,
                'nama_ruang'        => 'Ruang Meeting',
                'is_active'         => true,
                'pic_id'            => $picDefault?->id ?? null,
            ],
            [
                'lantai_id'         => 1,
                'jenis_ruangan_id'  => 2,
                'nama_ruang'        => 'Ruang Server',
                'is_active'         => true,
                'pic_id'            => $picDefault?->id ?? null,
            ],
            // Tambahkan data lain sesuai kebutuhan
        ];

        foreach ($dataRuang as $item) {
            $lantai = Lantai::with('gedung')->findOrFail($item['lantai_id']);
            $jenis  = JenisRuangan::findOrFail($item['jenis_ruangan_id']);

            // Generate kode_ruang (logic kamu tetap bagus)
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
                'pic_id'            => $item['pic_id'],           // ← Tambahkan ini
            ]);
        }

        $this->command->info('Ruang berhasil di-seed dengan kode ruang otomatis dan PIC default!');
    }
}
