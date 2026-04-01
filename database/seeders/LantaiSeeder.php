<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Lantai;

class LantaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lantais = [

            ['kode_lantai' => 'L1', 'gedung_id' => 1, 'nama_lantai' => 'Lantai 1'],
            ['kode_lantai' => 'L2', 'gedung_id' => 1, 'nama_lantai' => 'Lantai 2'],
            ['kode_lantai' => 'L1', 'gedung_id' => 2, 'nama_lantai' => 'Lantai 1'],
            ['kode_lantai' => 'L2', 'gedung_id' => 2, 'nama_lantai' => 'Lantai 2']

        ];

        DB::table('lantais')->insert($lantais);
        foreach ($lantais as $lantai) {

            Lantai::firstOrCreate(
                ['kode_lantai' => $lantai['kode_lantai']],
                $lantai
            );

        }
    }
}
