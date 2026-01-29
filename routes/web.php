<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/connect', [DashboardController::class, 'connect'])->name('device.connect');
    Route::get('/withdraw', [App\Http\Controllers\WithdrawController::class, 'index'])->name('withdraw.index');
    Route::post('/withdraw', [App\Http\Controllers\WithdrawController::class, 'store'])->name('withdraw.store');

Route::get('/simulation', [DashboardController::class, 'simulation'])->name('simulation');
Route::post('/simulation', [DashboardController::class, 'storeSimulation'])->name('simulation.store');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/withdrawals', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.withdraw.index');
    Route::patch('/withdrawals/{id}', [App\Http\Controllers\AdminController::class, 'updateStatus'])->name('admin.withdraw.update');
});
});

require __DIR__.'/auth.php';