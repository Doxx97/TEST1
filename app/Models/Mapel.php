<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    
    // Izinkan kolom ini diisi
    protected $fillable = ['nama', 'guru_id'];

    /**
     * Relasi: Satu Mata Pelajaran diajar oleh satu Guru.
     * Ini yang membuat `$mapel->guru` berfungsi.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}