<?php

use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomCategoryController;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('backend.login');
});
Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])
    ->name('backend.beranda')->middleware('auth');

Route::get('backend/login', [LoginController::class, 'loginBackend'])
    ->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])
    ->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])
    ->name('backend.logout');

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
