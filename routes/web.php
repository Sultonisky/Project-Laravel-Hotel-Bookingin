<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('backend.login.view');
});

// ROUTE AUTENTIKASI (Bisa diakses tanpa login)
Route::get('backend/login', [AuthController::class, 'login'])->name('backend.login.view');
Route::post('backend/login', [AuthController::class, 'loginAction'])->name('backend.login.post');
Route::post('backend/logout', [AuthController::class, 'logout'])->name('backend.logout');

Route::get('backend/register', [AuthController::class, 'register'])->name('backend.register.form');
Route::post('backend/register', [AuthController::class, 'registerSave'])->name('backend.register.submit');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('backend.dashboard.dashboard');
    })->name('dashboard');

    // Route::resource('backend/barang', ProductController::class, ['as' => 'backend']);
    Route::resource('backend/items', ItemController::class, ['as' => 'backend']);
    Route::resource('backend/categories', CategoryController::class, ['as' => 'backend']);
    Route::resource('backend/claims', ClaimController::class, ['as' => 'backend']);
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
});
