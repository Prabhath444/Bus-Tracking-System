<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\RouteController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LiveLocationController;
use App\Http\Controllers\Api\AlertController;
use App\Http\Controllers\Api\DashboardController;

Route::post('/login', [AuthController::class, 'login']);

//GPS Devices
Route::post('/location/ping', [LiveLocationController::class, 'storePing'])
    ->middleware('auth.apikey');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('buses', BusController::class);
    Route::apiResource('drivers', DriverController::class);
    Route::apiResource('routes', RouteController::class);
    Route::apiResource('schedules', ScheduleController::class);
    Route::apiResource('users', UserController::class);

    Route::get('/location/latest', [LiveLocationController::class, 'getLatestLocations'])->middleware('auth:sanctum');

    Route::get('/buses/{bus}/location/latest', [LiveLocationController::class, 'getLatestForBus']);

    Route::get('/alerts', [AlertController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'getStats']);
});
