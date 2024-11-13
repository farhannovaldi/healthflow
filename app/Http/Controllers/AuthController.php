<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('login');  // Menampilkan form login
    }

    // Proses login
    // Proses login
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Pastikan kita mengambil data dari tabel 'users'
        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            Auth::login($user);

            // Redirect ke dashboard setelah login berhasil
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Menampilkan halaman register
    public function showRegisterForm()
    {
        return view('register');  // Menampilkan form register
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // Validasi input registrasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',  // Memastikan email unik
            'password' => 'required|min:6|confirmed',  // Pastikan password dan konfirmasi password cocok
        ]);

        // Membuat user baru
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Pastikan password terenkripsi
        ]);


        // Redirect ke halaman login setelah registrasi
        return redirect()->route('login.form')->with('success', 'Akun Anda telah berhasil dibuat. Silakan login.');
    }


    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
