<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gurus')->insert([
            [
                'nipsn' => '11223344', // Akan digunakan sebagai 'username' login
                'nama' => 'Irwan Setiawan',
                'email' => 'Irwan.s@sekolah.id',
                'password' => Hash::make('passwordguru'), // Password ter-hash
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nipsn' => '44332211',
                'nama' => 'Lisa Rukmana',
                'email' => 'Lisa.r@sekolah.id',
                'password' => Hash::make('passwordguru'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}