<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nisn', 'kelas_id'];

    /**
     * Relasi: Satu Siswa dimiliki oleh satu Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}