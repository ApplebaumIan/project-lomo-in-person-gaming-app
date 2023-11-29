<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeaconController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('beacons', BeaconController::class);
    Route::apiResource('users', UserController::class)->except('store');
});
