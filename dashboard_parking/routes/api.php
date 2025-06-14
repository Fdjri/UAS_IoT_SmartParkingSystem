<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlotController;

// Route untuk mendapatkan status slot per hari berdasarkan filter terisi/kosong
Route::get('/slots/daily-hours', [SlotController::class, 'getSlots']);

// Route untuk menerima data POST dari ESP32 dan menyimpannya ke database
Route::post('/parking-slot', [SlotController::class, 'store']);

// Route untuk mendapatkan status terkini slot parkir (terisi/kosong)
Route::get('/slots/latest-status', [SlotController::class, 'getLatestStatus']);
