<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';
    protected $table = 'admins';

    // ========================================================
    // PERBAIKAN PRIMARY KEY UNTUK 'id_admin' (STRING)
    // ========================================================
    protected $primaryKey = 'id_admin'; // Beritahu apa Primary Key-nya
    public $incrementing = false;       // Beritahu ini BUKAN auto-increment
    protected $keyType = 'string';      // Beritahu tipe-nya string
    // ========================================================

    protected $fillable = [ 'id_admin', 'nama', 'email', 'password' ];
    protected $hidden = [ 'password', 'remember_token' ];
    protected $casts = [ 'password' => 'hashed' ];

    public function getAuthIdentifierName()
    {
        return 'id_admin';
    }
}