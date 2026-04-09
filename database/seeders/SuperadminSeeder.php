<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nid = '8913061ZJY';
        $password = '8913061ZJY';

        // Cek apakah user dengan NID sudah ada
        $user = User::where('nid', $nid)->first();
        
        if ($user) {
            // Jika ada, update passwordnya
            $user->update([
                'password' => Hash::make($password),
                'role' => 'superadmin'
            ]);
            $user->syncRoles(['superadmin']);
        } else {
            // Jika tidak ada, buat user baru
            $user = User::create([
                'name' => 'Super Admin',
                'nid' => $nid,
                'password' => Hash::make($password),
                'role' => 'superadmin'
            ]);
            $user->assignRole('superadmin');
        }
    }
}

