<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('walis')->insert([
            [
                'nama' => 'Ali Fahmi', // Akan digunakan untuk login
                'nisn_siswa' => '1122334455', // Akan digunakan untuk login
                'email' => 'ali.f@gmail.com',
                'password' => null, // Dibuat nullable sesuai form login Wali
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Raihan Gusta',
                'nisn_siswa' => '5544332211',
                'email' => 'raihan.g@gmail.com',
                'password' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}