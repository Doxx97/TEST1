<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  The required role (which is the guard name: 'admin', 'guru', or 'wali')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek guard yang diminta (misal 'admin')
        if (Auth::guard($role)->check()) {
            // BERHASIL. User adalah 'admin' dan sedang mengakses halaman 'admin'.
            return $next($request);
        }

        // 2. Jika gagal, cek apakah user login sebagai peran LAIN
        $guards = ['admin', 'guru', 'wali'];
        foreach ($guards as $guard) {
            if ($guard != $role && Auth::guard($guard)->check()) {
                // GAGAL. User login (misal sebagai 'guru') tapi mencoba akses halaman 'admin'.
                // Tendang ke landing dengan pesan error.
                return redirect()->route('landing')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
            }
        }

        // 3. Jika tidak lolos cek 1 dan 2, berarti user BELUM LOGIN SAMA SEKALI.
        // Arahkan ke halaman login yang sesuai.
        $loginRouteName = 'login.' . $role; // misal 'login.admin'
        
        // Cek apakah rute login ada sebelum redirect
        if (!app('router')->has($loginRouteName)) {
            // Fallback jika rute tidak ada
            return redirect()->route('landing')->with('error', 'Rute login tidak ditemukan.');
        }

        return redirect()->route($loginRouteName)->with('error', 'Silahkan login sebagai ' . $role . ' terlebih dahulu.');
    }
}