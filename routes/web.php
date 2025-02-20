<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MarketPriceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('deliveries', DeliveryController::class);
    Route::resource('marketPrices', MarketPriceController::class);
});
