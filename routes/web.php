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
Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])
    ->name('backend.beranda')->middleware('auth');

Route::get('backend/login', [LoginController::class, 'loginBackend'])
    ->name('backend.login.view');

Route::post('backend/login', [LoginController::class, 'authenticateBackend'])
    ->name('backend.login.post');

Route::post('backend/logout', [LoginController::class, 'logoutBackend'])
    ->name('backend.logout');


Route::get('backend/register', [RegisterController::class, 'registrationForm'])->name('backend.register.form');
Route::post('backend/register', [RegisterController::class, 'register'])->name('backend.register.submit');


Route::resource('backend/user', UserController::class, ['as' => 'backend'])
    ->middleware('auth');
Route::resource('backend/guest', GuestController::class, ['as' => 'backend']);

Route::resource('backend/category', RoomCategoryController::class, ['as' => 'backend'])
    ->middleware('auth');

Route::resource('backend/room', RoomController::class, ['as' => 'backend'])
    ->middleware('auth');

Route::resource('backend/reservation', ReservationController::class, ['as' => 'backend'])
    ->middleware('auth');

// Route untuk menambahkan foto 
Route::post('room/store', [RoomController::class, 'storeFoto'])
    ->name('backend.foto_produk.store')->middleware('auth');
// Route untuk menghapus foto 
Route::delete('room/{id}', [RoomController::class, 'destroyFoto'])
    ->name('backend.foto_produk.destroy')->middleware('auth');


Route::get('backend/report/formReservation', [ReservationController::class, 'formReservation'])
    ->name('backend.report.formReservation')->middleware('auth');
Route::post('backend/report/printReport', [ReservationController::class, 'printReport'])
    ->name('backend.report.printReport')->middleware('auth');

Route::delete('/reservation/cancel/{id}', [ReservationController::class, 'cancel'])
    ->name('backend.reservation.cancel');


Route::get('backend/roomGallery', [RoomController::class, 'roomGallery'])
    ->name('backend.room.roomGallery')->middleware('auth');
