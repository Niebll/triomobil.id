<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
        public function showLoginForm(): View
    {
        // Fungsi ini hanya mengembalikan view yang berisi form login.
        // Pastikan Anda punya file di: resources/views/auth/login.blade.php
    if (auth()->check()) {
        return redirect()->route('admin.dashboard.index');
    }

    return view('auth.login_admin');
    }

    //login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Coba login
        if (auth()->attempt($request->only('email', 'password'))) {
            // Jika berhasil, redirect ke dashboard
            return redirect()->route('dashboard.dashboard');
        }

        // Jika gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
    public function logout(Request $request): RedirectResponse
    {
    auth()->logout(); // Keluar dari session

    $request->session()->invalidate(); // Invalidasi session
    $request->session()->regenerateToken(); // Buat ulang CSRF token

    return redirect()->route('auth.login.form'); // Redirect ke login
    }

}
