<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Divisi;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['kode_divisi' => 'IT', 'nama_divisi' => 'IT'],
            ['kode_divisi' => 'OPS', 'nama_divisi' => 'Operasional'],
            ['kode_divisi' => 'KEU', 'nama_divisi' => 'Keuangan'],
            ['kode_divisi' => 'SDM', 'nama_divisi' => 'SDM'],
            ['kode_divisi' => 'UMM', 'nama_divisi' => 'Umum'],

        ];  

        DB::table('divisis')->insert($data);
        foreach ($data as $item) {

        Divisi::firstOrCreate(
            ['kode_divisi' => $item['kode_divisi']],
            ['nama_divisi' => $item['nama_divisi']]
        );

}
    }
}
