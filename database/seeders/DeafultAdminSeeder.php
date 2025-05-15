<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeafultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([

            'name' => 'admin',
            'email' => 'admin@bookmypet.com',
            'password' => 'bookmypet@2025',
            'is_admin' => true
        ]);
    }
}
