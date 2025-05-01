<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlatMusikController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;    

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Auth Routes - Guest Only
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    // Registration Routes
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    
    // Password Reset Routes
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
});

// Authenticated Routes - All Users
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart');
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders');
});

// Admin Only Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products
    Route::resource('products', ProductController::class)->except(['show']);
    
    // Alat Musik
    Route::resource('alatmusik', AlatMusikController::class);
    
    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::post('/{order}/approve', [OrderController::class, 'approve'])->name('admin.orders.approve');
        Route::post('/{order}/complete', [OrderController::class, 'complete'])->name('admin.orders.complete');
        Route::post('/{order}/cancel', [OrderController::class, 'cancel'])->name('admin.orders.cancel');
    });
    
    // Returns
    Route::prefix('returns')->group(function () {
        Route::get('/', [ReturnController::class, 'index'])->name('admin.returns.index');
        Route::post('/{order}/status', [ReturnController::class, 'updateStatus'])->name('admin.returns.update-status');
        Route::post('/{order}/process', [ReturnController::class, 'processReturn'])->name('admin.returns.process');
        Route::get('/{return}', [ReturnController::class, 'show'])->name('admin.returns.show');
    });
});