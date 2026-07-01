<?php

use Illuminate\Support\Facades\Route;

// Rute untuk halaman utama / Dashboard
Route::get('/', function () {
    return view('attendance');
});

// Rute untuk halaman Absensi (QR Code)
Route::get('/absensi', function () {
    return view('absensi');
});

// Rute untuk halaman Statistik
Route::get('/statistik', function () {
    return view('statistik');
});