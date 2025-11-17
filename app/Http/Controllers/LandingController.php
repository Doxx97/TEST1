<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- WAJIB ADA

/**
 * INI HARUS 'class LandingController'
 */
class LandingController extends Controller
{
    /**
     * Menampilkan halaman landing page utama.
     */
    public function index()
    {
        return view('landing');
    }

    /**
     * Menampilkan halaman pilihan peran (kita arahkan ke landing).
     */
    public function loginRole()
    {
        return view('landing'); 
    }

    /**
     * Memproses pilihan peran dan redirect ke form login yang sesuai.
     */
    public function processRoleSelection(Request $request)
    {
        $role = $request->input('role');

        if ($role == 'admin') {
            return redirect()->route('login.admin');
        } elseif ($role == 'guru') {
            return redirect()->route('login.guru');
        } elseif ($role == 'wali') {
            return redirect()->route('login.wali');
        }

        return back()->with('error', 'Silakan pilih peran.');
    }


    /**
     * Menghancurkan semua sesi guard dan me-redirect ke landing.
     */
    public function logout(Request $request)
    {
        // Logout dari semua guard yang mungkin aktif
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('guru')->logout();
        Auth::guard('wali')->logout();

        // Hancurkan sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}