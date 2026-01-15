<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Buat akun guru demo
        Teacher::updateOrCreate(
            ['email' => 'guru.arab@gameedukasi.com'],
            [
                'name' => 'Guru Bahasa Arab',
                'password' => Hash::make('Guru@2026!'),
                'phone' => '081234567890',
                'subject' => 'Bahasa Arab',
            ]
        );

        Teacher::updateOrCreate(
            ['email' => 'guru.inggris@gameedukasi.com'],
            [
                'name' => 'Guru Bahasa Inggris',
                'password' => Hash::make('Guru@2026!'),
                'phone' => '081234567891',
                'subject' => 'Bahasa Inggris',
            ]
        );

        Teacher::updateOrCreate(
            ['email' => 'siti@gameedukasi.com'],
            [
                'name' => 'Ibu Siti Nurhaliza',
                'password' => Hash::make('Guru@2026!'),
                'phone' => '081234567892',
                'subject' => 'Bahasa Indonesia',
            ]
        );
    }
}
