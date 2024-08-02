<?php

use App\Livewire\Bookings;
use App\Livewire\UserDashboard;
use App\Livewire\UserLogin;
use App\Livewire\UserRegister;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('not');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/bookings', UserRegister::class)->name('register');
    Route::get('/login', UserLogin::class)->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/book', Bookings::class)->name('book');
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');
});
