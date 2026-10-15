<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BuyerAuthController extends Controller
{
    // ──────────────────────────────────────────────
    // Halaman Login Pembeli
    // ──────────────────────────────────────────────
    public function showLogin()
    {
        if (Session::has('buyer')) {
            return redirect()->route('buyer.dashboard');
        }
        return view('buyer.login');
    }

    // ──────────────────────────────────────────────
    // Proses Login Pembeli
    // ──────────────────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $buyer = DB::table('buyers')
            ->where('email', $request->input('email'))
            ->first();

        if (!$buyer || !$buyer->password || !Hash::check($request->input('password'), $buyer->password)) {
            return back()->withErrors([
                'email' => 'Email atau password salah. Silakan coba lagi.',
            ])->withInput($request->only('email'));
        }

        // Simpan data buyer ke session
        Session::put('buyer', [
            'id'    => $buyer->id,
            'name'  => $buyer->name,
            'email' => $buyer->email,
            'phone' => $buyer->phone,
        ]);

        // Redirect ke halaman yang dituju atau dashboard tiket
        $intended = Session::pull('url.intended', route('buyer.dashboard'));
        return redirect($intended)->with('success', 'Selamat datang kembali, ' . $buyer->name . '!');
    }

    // ──────────────────────────────────────────────
    // Halaman Register Pembeli
    // ──────────────────────────────────────────────
    public function showRegister()
    {
        if (Session::has('buyer')) {
            return redirect()->route('buyer.dashboard');
        }
        return view('buyer.register');
    }

    // ──────────────────────────────────────────────
    // Proses Register Pembeli
    // ──────────────────────────────────────────────
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'required|string|max:20',
            'nik'      => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.unique'             => 'Email ini sudah terdaftar. Silakan login atau gunakan email lain.',
            'password.confirmed'       => 'Konfirmasi password tidak cocok.',
            'password.min'             => 'Password minimal 6 karakter.',
        ]);

        // Cek apakah email sudah ada
        $existing = DB::table('buyers')->where('email', $request->input('email'))->first();
        if ($existing) {
            return back()->withErrors(['email' => 'Email ini sudah terdaftar. Silakan login.'])->withInput();
        }

        $buyerId = DB::table('buyers')->insertGetId([
            'name'       => $request->input('name'),
            'email'      => $request->input('email'),
            'phone'      => $request->input('phone'),
            'nik'        => $request->input('nik'),
            'address'    => $request->input('address', 'Bukittinggi, Sumatera Barat'),
            'password'   => Hash::make($request->input('password')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Auto-login setelah registrasi
        Session::put('buyer', [
            'id'    => $buyerId,
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('buyer.dashboard')
            ->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $request->input('name') . '!');
    }

    // ──────────────────────────────────────────────
    // Logout Pembeli
    // ──────────────────────────────────────────────
    public function logout()
    {
        Session::forget('buyer');
        return redirect()->route('home')->with('info', 'Anda berhasil keluar dari akun pembeli.');
    }
}
