<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // WAJIB
use App\Models\Guru;                 // WAJIB

class LandingGuruController extends Controller
{
    public function showLoginForm()
    {
        return view('landingGuru');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'nipsn' => 'required',
            'password' => 'required',
        ]);

        // 1. Cari Admin secara manual
        $guru = Guru::where('nipsn', $request->nipsn)->first();

        // 2. Cek jika Admin ada DAN password-nya cocok
        if ($guru && Hash::check($request->password, $guru->password)) {

            // 3. Logout semua guard lain
            $request->session()->regenerate();

            Auth::guard('web')->logout();
            Auth::guard('admin')->logout();
            Auth::guard('wali')->logout();

            // 4. Login user ini secara EKSPLISIT
            Auth::guard('guru')->login($guru, $request->has('rememberMe'));
            
            // 5. Arahkan ke DASHBOARD
            return redirect()->intended(route('guru.dashboard'));
        }

        // 6. Jika gagal
        return back()->withErrors([
            'nipsn' => 'NIPSN atau Password salah.',
        ])->onlyInput('nipsn');
    }
}