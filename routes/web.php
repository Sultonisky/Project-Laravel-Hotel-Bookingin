<?php

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendRoomController;
use App\Http\Controllers\ProfileController;
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

    Route::resource('backend/contact', ContactController::class, ['as' => 'backend']);
});

// ** ROUTE USER (role = 0) **
Route::middleware('auth', 'role:0')->group(function () {
    // Frontend 
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/beranda/profile', [BerandaController::class, 'profileUser'])->name('profile');
    Route::get('/about', [BerandaController::class, 'about'])->name('about');
    Route::get('/room', [BerandaController::class, 'room'])->name('room');
    Route::get('/contact', [BerandaController::class, 'contact'])->name('contact');
    Route::post('contact/send', [BerandaController::class, 'contactStore'])->name('contact.store')->middleware('auth');
    Route::get('/room/detail/{id}', [FrontendRoomController::class, 'room_detail'])->name('room.detail');
    Route::get('/room/reservation', [FrontendRoomController::class, 'reservation'])->name('room.reservation');
    Route::get('/room/select', [BerandaController::class, 'selectRoomByDate'])->name('room.select');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
});
