<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Light And Glow Bukittinggi
|--------------------------------------------------------------------------
*/

// 1. Landing Page (Folder template)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 1.1 Dashboard Pembeli (Template Goers: Riwayat Pembelian & Tiket Transaksi)
Route::get('/tiket-saya', function () {
    return view('buyer.dashboard');
})->name('buyer.dashboard');

// 2. Autentikasi (Adminator 4.4.0)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// 3. Dashboard Admin Utama (Adminator 4.4.0)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 4. CMS & Master Data
Route::get('/dashboard/cms', function () {
    return view('admin.cms');
})->name('admin.cms');

Route::get('/dashboard/tiket', function () {
    return view('admin.tiket');
})->name('admin.tiket');

Route::get('/dashboard/banner', function () {
    return view('admin.banner');
})->name('admin.banner');

Route::get('/dashboard/acara', function () {
    return view('admin.acara');
})->name('admin.acara');

// 5. Verifikasi Pembayaran (Berdasarkan rancangan web.txt)
Route::get('/dashboard/verifikasi', function () {
    return view('admin.verifikasi');
})->name('admin.verifikasi');

// 6. Scanner QR Code Petugas Check-in (Berdasarkan rancangan web.txt)
Route::get('/dashboard/scanner', function () {
    return view('admin.scanner');
})->name('admin.scanner');

// 7. Data Pesanan, Kehadiran, & Petugas
Route::get('/dashboard/pesanan', function () {
    return view('admin.pesanan');
})->name('admin.pesanan');

Route::get('/dashboard/kehadiran', function () {
    return view('admin.kehadiran');
})->name('admin.kehadiran');

Route::get('/dashboard/petugas', function () {
    return view('admin.petugas');
})->name('admin.petugas');

// 8. Error Pages (Adminator 4.4.0)
Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/500', function () {
    return response()->view('errors.500', [], 500);
});
