<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WithdrawController;
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

    Route::get('/s/{device_code}', [DashboardController::class, 'handleQrScan'])->name('qr.scan');

    Route::get('/device/connect/{device_code}', [DashboardController::class, 'connect'])->name('device.connect');
    Route::get('/setor', [DashboardController::class, 'setor'])->name('setor.index');
    Route::post('/setor/trigger', [DashboardController::class, 'triggerDevice'])->name('setor.trigger');
    Route::get('/check-transaction/{device_code}', [DashboardController::class, 'checkLatestTransaction'])->name('check.transaction');

    Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
    Route::post('/withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');

    Route::get('/sedekah', [DonationController::class, 'index'])->name('donation.index');
    Route::post('/sedekah', [DonationController::class, 'store'])->name('donation.store');

    Route::get('/history', [HistoryController::class, 'index'])->name('history');

    Route::post('/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markRead');

    Route::get('/simulation', [DashboardController::class, 'simulation'])->name('simulation');
    Route::post('/simulation', [DashboardController::class, 'storeSimulation'])->name('simulation.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/withdrawals', [AdminController::class, 'index'])->name('admin.withdraw.index');
    Route::post('/withdrawals/{id}/approve', [AdminController::class, 'approve'])->name('admin.withdraw.approve');
    Route::post('/withdrawals/{id}/reject', [AdminController::class, 'reject'])->name('admin.withdraw.reject');
});

require __DIR__.'/auth.php';