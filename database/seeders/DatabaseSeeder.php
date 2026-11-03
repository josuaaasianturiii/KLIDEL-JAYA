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
        // Default User / Pasien
        User::updateOrCreate(
            ['email' => 'user@aihealth.com'],
            [
                'name' => 'Rina Anggraini',
                'password' => bcrypt('password'),
                'role' => 'user',
            ]
        );

        // Default Admin
        User::updateOrCreate(
            ['email' => 'admin@aihealth.com'],
            [
                'name' => 'Amélie Laurent',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );
    }
}
