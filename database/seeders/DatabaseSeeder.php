<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Panggil seeder yang baru dibuat
            GuruSeeder::class,
            WaliSeeder::class,
            AdminSeeder::class,]);
    }
}