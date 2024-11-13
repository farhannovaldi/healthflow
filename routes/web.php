<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\JadwaldokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PasienvisitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/data/dokter', [DashboardController::class, 'getDokter']);
Route::get('/data/jadwaldokter', [DashboardController::class, 'getJadwalDokter']);
Route::get('/data/obat', [DashboardController::class, 'getObat']);
Route::get('/data/pasien', [DashboardController::class, 'getPasien']);
Route::get('/data/pasienvisit', [DashboardController::class, 'getPasienVisit']);
// Route untuk Dokter
Route::resource('dokter', DokterController::class);

// Route untuk Obat
Route::resource('obat', ObatController::class);

// Route untuk Jadwal Dokter
Route::resource('jadwaldokter', JadwaldokterController::class);

// Route untuk Pasien
Route::resource('pasien', PasienController::class);

// Route untuk Riwayat Kunjungan Pasien (Pasienvisit)
Route::resource('pasienvisit', PasienvisitController::class);
