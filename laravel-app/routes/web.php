<?php

use Illuminate\Support\Facades\Route;

// Halaman Depan / Landing Page Light And Glow Bukittinggi
Route::get('/', function () {
    return view('welcome');
});

// Halaman Dashboard Admin Light And Glow Bukittinggi (Adminator 4.4.0)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
