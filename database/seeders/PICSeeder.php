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

            ['nid_pic' => '12345678AB', 'divisi_id' => 1, 'nama_pic' => 'Andi Pratama', 'jabatan' => 'Manager', 'no_hp' => '081234567890', 'email' => 'andi.pratama@example.com'],
            ['nid_pic' => '23456789ZE', 'divisi_id' => 1, 'nama_pic' => 'Budi Santoso', 'jabatan' => 'Staff Magang', 'no_hp' => '081234567891', 'email' => 'budi.santoso@example.com'],
            ['nid_pic' => '34567890GA', 'divisi_id' => 2, 'nama_pic' => 'Citra Lestari', 'jabatan' => 'Intern', 'no_hp' => '081234567892', 'email' => 'citra.lestari@example.com'],
            ['nid_pic' => '45678901FI', 'divisi_id' => 3, 'nama_pic' => 'Dedi Kurniawan', 'jabatan' => 'Supervisor', 'no_hp' => '081234567893', 'email' => 'dedi.kurniawan@example.com'],
            ['nid_pic' => '56789012KO', 'divisi_id' => 4, 'nama_pic' => 'Eka Putri', 'jabatan' => 'Sekretaris', 'no_hp' => '081234567894', 'email' => 'eka.putri@example.com'],

        ];

        DB::table('pics')->insert($data);
        foreach ($data as $item) {

        Pic::firstOrCreate(
            ['nid_pic' => $item['nid_pic']],
            [
                'divisi_id' => $item['divisi_id'],
                'nama_pic' => $item['nama_pic'],
                'jabatan' => $item['jabatan'],
                'no_hp' => $item['no_hp'],
                'email' => $item['email']
            ]
        );

}
    }
}
