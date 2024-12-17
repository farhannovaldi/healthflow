<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\JadwaldokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PasienvisitController;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rute untuk halaman login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Rute untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk dashboard yang dilindungi oleh middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data Pasien
    Route::resource('pasien', PasienController::class);

    // Data Dokter
    Route::resource('dokter', DokterController::class);

    // Jadwal Dokter
    Route::get('/jadwaldokter/getJadwal', [JadwalDokterController::class, 'getJadwal'])->name('jadwaldokter.getJadwal');
    Route::get('/getAllJadwal', [JadwalDokterController::class, 'getAllJadwal'])->name('jadwaldokter.getAllJadwal');
    Route::resource('jadwaldokter', JadwaldokterController::class);

    // Data Obat
    Route::resource('obat', ObatController::class);

    // History Pasien
    Route::resource('pasienvisit', PasienvisitController::class);
});
