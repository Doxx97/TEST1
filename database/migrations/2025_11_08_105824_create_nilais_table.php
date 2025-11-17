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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->foreignId('mapels_id')->constrained('mapels');
            $table->foreignId('tahun_pelajaran_id')->constrained('tahun_pelajarans');
            
            $table->integer('nilai_angka')->nullable();
            // Kolom ini yang akan dicek oleh Controller Admin
            $table->enum('status', ['draft', 'terkirim'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
