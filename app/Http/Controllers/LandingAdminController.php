<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // WAJIB
use App\Models\Admin;                 // WAJIB

class LandingAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('landingAdmin');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'id_admin' => 'required|string',
            'password' => 'required',
        ]);

        // 1. Cari Admin secara manual
        $admin = Admin::where('id_admin', $request->id_admin)->first();

        // 2. Cek jika Admin ada DAN password-nya cocok
        if ($admin && Hash::check($request->password, $admin->password)) {
            
            // 3. Logout semua guard lain
            Auth::guard('web')->logout();
            Auth::guard('guru')->logout();
            Auth::guard('wali')->logout();

            // 4. Login user ini secara EKSPLISIT
            Auth::guard('admin')->login($admin, $request->has('rememberMe'));
            
            $request->session()->regenerate();
            
            // 5. Arahkan ke DASHBOARD
            return redirect()->intended(route('admin.dashboard'));
        }

        // 6. Jika gagal
        return back()->withErrors([
            'id_admin' => 'ID Admin atau Password salah.',
        ])->onlyInput('id_admin');
    }
}