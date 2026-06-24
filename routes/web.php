<?php

use App\Http\Controllers\AttendanceController;

Route::get('/', [AttendanceController::class, 'index']);
Route::post('/absen', [AttendanceController::class, 'store']);