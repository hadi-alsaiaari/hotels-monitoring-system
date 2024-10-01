<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\AccommodationController;
use Illuminate\Support\Facades\Route;

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

Route::post('auth/access-tokens', [AccessTokensController::class, 'store'])
    ->middleware(['guest:sanctum']);

Route::group([
    'middleware' => ['auth:sanctum', 'check_receptionist'],
], function () {
    Route::delete('auth/access-tokens/{token?}', [AccessTokensController::class, 'destroy']);

    Route::get('bookings', [AccommodationController::class, 'index']);
    Route::get('bookings/{booking}', [AccommodationController::class, 'show']);

    Route::post('bookings/add-booking', [AccommodationController::class, 'AddAccommodation']);
    Route::put('bookings/add-guest', [AccommodationController::class, 'addGuest']);
    Route::post('bookings/exit-booking', [AccommodationController::class, 'exitAccommodation']);
    Route::post('bookings/exit-guest', [AccommodationController::class, 'exitGuest']);
});
