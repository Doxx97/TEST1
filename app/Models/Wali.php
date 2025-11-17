<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Wali extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'wali';
    protected $table = 'walis';

    // ========================================================
    // KEMBALIKAN PENGATURAN INI (Ini akan memperbaiki LOGIN LOOP)
    // ========================================================
    protected $primaryKey = 'nisn_siswa'; // Beritahu apa Primary Key-nya
    public $incrementing = false;         // Beritahu ini BUKAN auto-increment
    protected $keyType = 'string';        // Beritahu tipe-nya string
    // ========================================================

    protected $fillable = [ 'nama', 'nisn_siswa', 'email', 'password' ];
    protected $hidden = [ 'password', 'remember_token' ];
    protected $casts = [ 'password' => 'hashed' ];
    
    public function getAuthIdentifierName()
    {
        return 'nisn_siswa';
    }
}