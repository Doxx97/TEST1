<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LandingAdminController; // TAMBAHKAN
use App\Http\Controllers\LandingGuruController;  // TAMBAHKAN
use App\Http\Controllers\LandingWaliController;  // TAMBAHKAN

//CRUD
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;


Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::post('/logout', [LandingController::class, 'logout'])->name('logout');

// 1. Route GET untuk menampilkan halaman pilihan peran (jika ada)
Route::get('/login-role', [LandingController::class, 'loginRole'])->name('login.role');

// 2. Route POST untuk memproses form pilihan peran
Route::post('/login-role', [LandingController::class, 'processRoleSelection'])->name('login.role.submit');

// ROUTE LOGIN ADMIN
Route::get('/admin/login', [LandingAdminController::class, 'showLoginForm'])->name('login.admin'); // Ganti Closure ke Controller
Route::post('/admin/login', [LandingAdminController::class, 'authenticate'])->name('admin.login.submit'); // TAMBAHKAN POST

// ROUTE LOGIN GURU
Route::get('/guru/login', [LandingGuruController::class, 'showLoginForm'])->name('login.guru'); // Ganti Closure ke Controller
Route::post('/guru/login', [LandingGuruController::class, 'authenticate'])->name('guru.login.submit'); // TAMBAHKAN POST

// ROUTE LOGIN WALI
Route::get('/wali/login', [LandingWaliController::class, 'showLoginForm'])->name('login.wali'); // Ganti Closure ke Controller
Route::post('/wali/login', [LandingWaliController::class, 'authenticate'])->name('wali.login.submit'); // TAMBAHKAN POST

// Contoh Halaman Setelah Login (Admin Dashboard, dst.)
Route::get('/admin/home', function () {
    return view('HomeAdminD'); 
})->name('admin.home')->middleware('role.access:admin'); // <-- TAMBAHKAN MIDDLEWARE

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']) 
     ->name('admin.dashboard')
     ->middleware('role.access:admin');
//CRUD
Route::middleware(['role.access:admin'])->group(function () { 
    Route::resource('tahun-pelajaran', TahunPelajaranController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('siswa', SiswaController::class);
});

// 2. Dashboard Guru
// Hanya bisa diakses jika sudah login sebagai 'guru'
Route::get('/guru/home', function () {
    return view('HomeGuruD');
})->name('guru.home')->middleware('role.access:guru'); // <-- TAMBAHKAN MIDDLEWARE

Route::get('/guru/dashboard', function () {
    return view('GuruDashboard');
})->name('guru.dashboard')->middleware('role.access:guru');

// 3. Dashboard Wali
// Hanya bisa diakses jika sudah login sebagai 'wali'
Route::get('/wali/dashboard', function () {
    return view('WaliDashboard');
})->name('wali.dashboard')->middleware('role.access:wali'); // <-- TAMBAHKAN MIDDLEWARE
