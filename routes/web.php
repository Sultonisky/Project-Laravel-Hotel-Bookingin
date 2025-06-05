<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

// ROUTE AUTENTIKASI (Tanpa login)
Route::get('backend/login', [AuthController::class, 'login'])->name('login');
Route::post('backend/login', [AuthController::class, 'loginAction'])->name('loginAction');
Route::post('backend/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('backend/register', [AuthController::class, 'register'])->name('register');
Route::post('backend/register', [AuthController::class, 'registerSave'])->name('registerSave');


// ROUTES UNTUK ADMIN
Route::middleware(['auth', 'role:admin,donatur'])->prefix('backend')->name('backend.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('penerima', PenerimaController::class);
    Route::resource('claims', ClaimController::class);
    Route::get('items/status/logs', [ItemController::class, 'showLogStatus'])->name('showStatusLogs');

    // Hanya admin yang bisa akses 'users' dan 'messages'
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('messages', MessageController::class);
    });

    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});



// ROUTE KHUSUS UNTUK PENERIMA
Route::middleware(['auth', 'role:penerima'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('frontend.home');
});
