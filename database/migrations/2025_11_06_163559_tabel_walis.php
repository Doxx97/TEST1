<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('walis', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama Wali Murid
            $table->string('nisn_siswa')->index(); // NISN siswa yang diwakili (sebagai kunci lookup)
            $table->string('email')->unique()->nullable(); 
            $table->string('password')->nullable(); // Dapat diisi/nullable tergantung kebutuhan keamanan Anda
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walis');
    }
};
