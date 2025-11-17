<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'id_admin' => 'Gusta0099', // Akan digunakan untuk login
                'nama' => 'Admin', // Akan digunakan untuk login
                'email' => 'admin@sekolah.id',
                'password' => Hash::make('passwordadmin'), // Dibuat nullable sesuai form login Wali
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}