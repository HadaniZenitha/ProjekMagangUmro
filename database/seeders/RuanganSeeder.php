<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Ruang;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangs = [

            [
                'kode_ruang' => 'R001',
                'lantai_id' => 1,
                'jenis_ruangan_id' => 1, // Ruang Kerja
                'nama_ruang' => 'Ruang IT'
            ],

            [
                'kode_ruang' => 'R002',
                'lantai_id' => 1,
                'jenis_ruangan_id' => 4, // Server Room
                'nama_ruang' => 'Ruang Server'
            ],

            [
                'kode_ruang' => 'R003',
                'lantai_id' => 2,
                'jenis_ruangan_id' => 1, // Ruang Kerja
                'nama_ruang' => 'Ruang HR'
            ],

            [
                'kode_ruang' => 'R004',
                'lantai_id' => 3,
                'jenis_ruangan_id' => 1, // Ruang Kerja
                'nama_ruang' => 'Ruang Keuangan'
            ],

            [
                'kode_ruang' => 'R005',
                'lantai_id' => 4,
                'jenis_ruangan_id' => 2, // Ruang Meeting
                'nama_ruang' => 'Ruang Operasional'
            ]

        ];

        DB::table('ruangs')->insert($ruangs);

        foreach ($ruangs as $ruang) {

            Ruang::firstOrCreate(
                ['kode_ruang' => $ruang['kode_ruang']],
                $ruang
            );

        }
    }
}
