<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\MidtransWebhookController;
=======
>>>>>>> 3d9f03e28f0f29b18fa29872119da2dbd9d6154d

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
<<<<<<< HEAD

Route::post('/midtrans/webhook', [MidtransWebhookController::class, 'handle']);
=======
>>>>>>> 3d9f03e28f0f29b18fa29872119da2dbd9d6154d
