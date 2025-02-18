<?php

use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomCategoryController;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('backend.login.view');
});

// ROUTE AUTENTIKASI (Bisa diakses tanpa login)
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login.view');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login.post');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

Route::get('backend/register', [RegisterController::class, 'registrationForm'])->name('backend.register.form');
Route::post('backend/register', [RegisterController::class, 'register'])->name('backend.register.submit');

//  DASHBOARD (Auth Login) **
Route::middleware('auth')->group(function () {
    Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda');
});

// ** ROUTE ADMIN (role = 1) **
Route::middleware(['auth', 'role:1'])->group(function () {
    // Manajemen User
    Route::resource('backend/user', UserController::class, ['as' => 'backend']);

    // Manajemen Kategori Kamar
    Route::resource('backend/category', RoomCategoryController::class, ['as' => 'backend']);

    // Manajemen Kamar
    Route::resource('backend/room', RoomController::class, ['as' => 'backend']);

    // Upload dan Hapus Foto Kamar
    Route::post('room/store', [RoomController::class, 'storeFoto'])->name('backend.foto_produk.store');
    Route::delete('room/{id}', [RoomController::class, 'destroyFoto'])->name('backend.foto_produk.destroy');
});

// ** ROUTE ADMIN & STAFF (role = 0 atau 1) **
Route::middleware('auth')->group(function () {
    // Manajemen Tamu
    Route::resource('backend/guest', GuestController::class, ['as' => 'backend']);

    // Manajemen Reservasi
    Route::resource('backend/reservation', ReservationController::class, ['as' => 'backend']);

    // Laporan Reservasi
    Route::get('backend/report/formReservation', [ReservationController::class, 'formReservation'])->name('backend.report.formReservation');
    Route::post('backend/report/printReport', [ReservationController::class, 'printReport'])->name('backend.report.printReport');

    // Pembatalan Reservasi
    Route::delete('/reservation/cancel/{id}', [ReservationController::class, 'cancel'])->name('backend.reservation.cancel');

    // Reschedule Reservasi
    Route::get('backend/reservasi/{id}/rescheduleForm', [ReservationController::class, 'rescheduleForm'])->name('backend.reservation.rescheduleForm');
    Route::put('backend/reservasi/{id}/reschedule', [ReservationController::class, 'reschedule'])->name('backend.reservation.reschedule');

    // Galeri Kamar
    Route::get('backend/roomGallery', [RoomController::class, 'roomGallery'])->name('backend.room.roomGallery');
});
