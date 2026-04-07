<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vrilla@gmail.com')->first();
        
        if ($user) {
            $user->update(['role' => 'superadmin']);
            $user->syncRoles(['superadmin']);
        }
    }
}
