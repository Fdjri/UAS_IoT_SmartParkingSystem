<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlotController;

Route::get('/slots/daily-hours', [SlotController::class, 'getSlots']);
Route::post('/parking-slot', [SlotController::class, 'store']);