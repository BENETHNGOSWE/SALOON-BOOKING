<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('registerform', 'auth.register')->name('register');
Route::view('loginform', 'auth.login')->name('login');
Route::post('register', [App\Http\Controllers\Auth\AuthenticationController::class, 'register'])->name('register.form');
Route::post('login', [App\Http\Controllers\Auth\AuthenticationController::class, 'login'])->name('login.form');

Route::view('send-booking', 'bookings.create')->name('booking.create');
Route::post('save-booking', [App\Http\Controllers\Booking\BookingController::class, 'store'])->name('booking.store');

Route::middleware(['auth', 'role:admin'])->group( function() {
    // Route::view('admin/dashboard','Dashboards.admin.dashboard')->name('admin.dashboard');
    Route::get('admin/dashboard', [App\Http\Controllers\Booking\BookingController::class, 'index'])->name('admin.dashboard');
    Route::get('accept-booking/{id}', [App\Http\Controllers\Booking\BookingController::class, 'accept_booking'])->name('accept.booking');
    Route::get('reject-booking/{id}', [App\Http\Controllers\Booking\BookingController::class, 'reject_booking'])->name('reject.booking');
});