<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\JenisRuangan;

class JenisRuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['kode_jenis_ruangan' => 'RK', 'nama_jenis_ruangan' => 'Ruang Kerja'],
            ['kode_jenis_ruangan' => 'RM', 'nama_jenis_ruangan' => 'Ruang Meeting'],
            ['kode_jenis_ruangan' => 'GD', 'nama_jenis_ruangan' => 'Gudang'],
            ['kode_jenis_ruangan' => 'SR', 'nama_jenis_ruangan' => 'Server Room'],
            ['kode_jenis_ruangan' => 'RA', 'nama_jenis_ruangan' => 'Ruang Arsip']

        ];

        DB::table('jenis_ruangans')->insert($data);

        foreach ($data as $item) {

        JenisRuangan::firstOrCreate(
            ['kode_jenis_ruangan' => $item['kode_jenis_ruangan']],
            ['nama_jenis_ruangan' => $item['nama_jenis_ruangan']]
        );
        }
    }
}
