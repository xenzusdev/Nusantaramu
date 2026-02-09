<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IoTController;
use App\Http\Middleware\CheckIoTSecret;

Route::middleware(['throttle:60,1', CheckIoTSecret::class])->group(function () {
    Route::get('/iot/command', [IoTController::class, 'getCommand']);
    Route::post('/iot/store', [IoTController::class, 'store']);

});

Route::post('/iot/store', [IoTController::class, 'store']);

Route::get('/iot/command', [App\Http\Controllers\Api\IoTController::class, 'getCommand']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');