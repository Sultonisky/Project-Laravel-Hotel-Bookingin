<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

// ROUTE AUTENTIKASI (Tanpa login)
Route::get('backend/login', [AuthController::class, 'login'])->name('login'); // menampilkan halaman login
Route::post('backend/login', [AuthController::class, 'loginAction'])->name('loginAction'); // proses login
Route::post('backend/logout', [AuthController::class, 'logout'])->name('logout'); // proses logout

Route::get('backend/register', [AuthController::class, 'register'])->name('register'); // menampilkan halaman register 
Route::post('backend/register', [AuthController::class, 'registerSave'])->name('registerSave'); // proses register


// ROUTES HANYA BISA DIAKSES OLEH ADMIN DAN ADMIN WAJIB LOGIN DAHULU
Route::middleware(['auth', 'role:admin'])->prefix('backend')->name('backend.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('penerima', PenerimaController::class);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('items', ItemController::class);
    Route::resource('claims', ClaimController::class);
    // Route::get('items/status/logs', [ItemController::class, 'showLogStatus'])->name('showStatusLogs');
    Route::resource('messages', MessageController::class);


    Route::get('/profile/show', [UserController::class, 'profile'])->name('profile.show');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});



// ROUTE KHUSUS UNTUK PENERIMA
Route::middleware(['auth', 'role:penerima'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'beranda'])->name('beranda');
    Route::post('/items/claims', [BerandaController::class, 'claimItems'])->name('itemsClaim');
    Route::get('/items', [BerandaController::class, 'items'])->name('items');
    Route::get('/claim-form/{item}', [BerandaController::class, 'formClaim'])->name('claims.form');
    Route::get('/about', [BerandaController::class, 'about'])->name('about');
    Route::get('/contact', [BerandaController::class, 'contact'])->name('contact');
    Route::get('/history', [BerandaController::class, 'history'])->name('history');
    Route::post('/contact/post', [BerandaController::class, 'contactStore'])->name('contactStore');
});
