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

// 4. CMS Landing Page (Admin dapat mengubah teks & konten landing page)
Route::get('/dashboard/cms', function () {
    return view('admin.cms');
})->name('admin.cms');

// 5. Verifikasi Pembayaran (Berdasarkan rancangan web.txt)
Route::get('/dashboard/verifikasi', function () {
    return view('admin.verifikasi');
})->name('admin.verifikasi');

// 6. Scanner QR Code Petugas Check-in (Berdasarkan rancangan web.txt)
Route::get('/dashboard/scanner', function () {
    return view('admin.scanner');
})->name('admin.scanner');

// 7. Data Pesanan & Kuota Tiket
Route::get('/dashboard/pesanan', function () {
    return view('admin.verifikasi');
})->name('admin.pesanan');

Route::get('/dashboard/tiket', function () {
    return view('admin.verifikasi');
})->name('admin.tiket');

Route::get('/dashboard/kehadiran', function () {
    return view('admin.verifikasi');
})->name('admin.kehadiran');

Route::get('/dashboard/petugas', function () {
    return view('admin.verifikasi');
})->name('admin.petugas');

// 8. Error Pages (Adminator 4.4.0)
Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/500', function () {
    return response()->view('errors.500', [], 500);
});
