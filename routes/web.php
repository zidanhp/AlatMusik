<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PemesananController;
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
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index2');
    })->name('dashboard.index2');
    
    // Products
    Route::resource('products', ProductController::class)->except(['show']);
    
    // Alat Musik
    Route::resource('alatmusik', AlatMusikController::class);

    Route::get('/dashboard/orders', [PemesananController::class, 'index'])->name('dashboard.orders');
    
    // Orders
    Route::get('/dashboard/produk', [ProdukController::class, 'index'])->name('dashboard.produk.index');
    Route::get('/dashboard/produk/create', [ProdukController::class, 'create'])->name('dashboard.produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');;
    
    // Returns
    Route::prefix('returns')->group(function () {
        Route::get('/', [ReturnController::class, 'index'])->name('admin.returns.index');
        Route::post('/{order}/status', [ReturnController::class, 'updateStatus'])->name('admin.returns.update-status');
        Route::post('/{order}/process', [ReturnController::class, 'processReturn'])->name('admin.returns.process');
        Route::get('/{return}', [ReturnController::class, 'show'])->name('admin.returns.show');
    });
});