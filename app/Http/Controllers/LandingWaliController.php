<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // WAJIB
use App\Models\Wali;                 // WAJIB

class LandingWaliController extends Controller
{
    public function showLoginForm()
    {
        return view('landingWali');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'nisn_siswa' => 'required|string',
            'password' => 'required',
        ]);

        // 1. Coba cari wali
        $wali = Wali::where('nisn_siswa', $request->nisn_siswa)->first();

        // 2. Jika wali TIDAK DITEMUKAN
        if (! $wali) {
            dd('DEBUG 1: GAGAL. Wali dengan NISN Siswa ' . $request->nisn_siswa . ' tidak ditemukan.');
        }

        // 3. Jika wali DITEMUKAN, cek passwordnya
        if (! Hash::check($request->password, $wali->password)) {
            dd(
                'DEBUG 2: GAGAL. Password salah.', 
                'Password Anda (plain): ' . $request->password, 
                'Password di DB (hash): ' . $wali->password
            );
        }

        // 4. JIKA LOLOS SEMUA, login berhasil
        
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('guru')->logout();

        Auth::guard('wali')->login($wali, $request->has('rememberMe'));
        
        $request->session()->regenerate();
        
        return redirect()->intended(route('wali.dashboard'));
    }
}