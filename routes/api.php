<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware('guest')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bookings', [BookingController::class, 'book']);
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
    Route::get('all-bookings', [BookingController::class, 'allBookings'])->middleware('can:admin');
});
