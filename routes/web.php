<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReturnController;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products
    Route::resource('products', ProductController::class)->except(['show']);
    
    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    
    // Returns
    Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
    Route::post('/returns/{order}/status', [ReturnController::class, 'updateStatus'])->name('returns.update-status');
    Route::post('/returns/{order}/process', [ReturnController::class, 'processReturn'])->name('returns.process');
    Route::get('/returns/{return}', [ReturnController::class, 'show'])->name('returns.show');
});


Route::get('/contact', [HomeController::class, 'contact']);