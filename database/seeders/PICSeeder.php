<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pic;

class PICSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['nid_pic' => 'PIC001', 'divisi_id' => 1, 'nama_pic' => 'Andi Pratama', 'jabatan' => 'Manager'],
            ['nid_pic' => 'PIC002', 'divisi_id' => 1, 'nama_pic' => 'Budi Santoso', 'jabatan' => 'Staff Magang'],
            ['nid_pic' => 'PIC003', 'divisi_id' => 2, 'nama_pic' => 'Citra Lestari', 'jabatan' => 'Intern'],
            ['nid_pic' => 'PIC004', 'divisi_id' => 3, 'nama_pic' => 'Dedi Kurniawan', 'jabatan' => 'Supervisor'],
            ['nid_pic' => 'PIC005', 'divisi_id' => 4, 'nama_pic' => 'Eka Putri', 'jabatan' => 'Sekretaris'],

        ];

        DB::table('pics')->insert($data);
        foreach ($data as $item) {

        Pic::firstOrCreate(
            ['nid_pic' => $item['nid_pic']],
            [
                'divisi_id' => $item['divisi_id'],
                'nama_pic' => $item['nama_pic']
            ]
        );

}
    }
}
