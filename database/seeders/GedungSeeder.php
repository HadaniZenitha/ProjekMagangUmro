<?php

namespace Database\Seeders;

use App\Models\Gedung;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['kode_gedung' => 'SB', 'nama_gedung' => 'Smart Building'],
            ['kode_gedung' => 'UP', 'nama_gedung' => 'Unit Pembangkit'],
            ['kode_gedung' => 'GD', 'nama_gedung' => 'Gudang Penyimpanan']
        ];

        DB::table('gedungs')->insert($data);
        foreach ($data as $item) {

        Gedung::firstOrCreate(
            ['kode_gedung' => $item['kode_gedung']],
            ['nama_gedung' => $item['nama_gedung']]
            );
        }
    }
}
