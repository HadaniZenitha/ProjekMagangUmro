<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
        ]);

        $this->call([
            RoleSeeder::class,
            SuperadminSeeder::class,
            MasterBarangPOBSeeder::class,
            DivisiSeeder::class,
            BidangSeeder::class,
            PICSeeder::class,
            GedungSeeder::class,
            LantaiSeeder::class,
            JenisRuanganSeeder::class,
            RuanganSeeder::class,
        ]);
    }
}
