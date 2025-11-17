<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'guru';
    protected $table = 'gurus';

    protected $primaryKey = 'nipsn';
    public $incrementing = false;        
    protected $keyType = 'string';       
    // ========================================================

    protected $fillable = [ 'nipsn', 'nama', 'email', 'password' ];
    protected $hidden = [ 'password', 'remember_token' ];
    protected $casts = [ 'password' => 'hashed' ];

    /**
     * Beritahu Auth untuk login pakai 'nipsn', BUKAN 'id'
     */
    public function getAuthIdentifierName()
    {
        return 'nipsn'; // Kolom untuk login
    }
}