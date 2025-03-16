<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MarketPriceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index']);
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

// Guest Routes
Route::name('guest.')->group(function () {
    Route::get('/', [GuestController::class, 'index'])->name('home');
    Route::get('/marketplace', [GuestController::class, 'marketplace'])->name('marketplace');
    Route::get('/search', [GuestController::class, 'search'])->name('search');
    Route::get('/product/{product}', [GuestController::class, 'productDetail'])->name('product-detail');
    Route::get('/farmers', [GuestController::class, 'farmers'])->name('farmers');
    Route::get('/buyers', [GuestController::class, 'buyers'])->name('buyers');
    Route::get('/contact', [GuestController::class, 'contact'])->name('contact');
    Route::post('/contact', [GuestController::class, 'submitContact'])->name('contact.submit');
    Route::get('/privacy', [GuestController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [GuestController::class, 'terms'])->name('terms');
    Route::post('/newsletter', [GuestController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // Order Routes
    Route::post('/order', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/{order}/success', [OrderController::class, 'success'])->name('order.success');
});

require __DIR__.'/auth.php';
