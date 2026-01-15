<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Buat admin user untuk Filament
        User::updateOrCreate(
            ['email' => 'admin@gameedukasi.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@2026!'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin2@gameedukasi.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@2026!'),
            ]
        );
    }
}
