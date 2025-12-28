<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => redirect()->route('login'));
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Daily Logs (CRUD)
    Route::resource('daily-logs', DailyLogController::class);

    // Verification (only for users with subordinates)
    Route::middleware('has.subordinates')->group(function () {
        Route::get('/verifications', [VerificationController::class, 'index'])->name('verifications.index');
        Route::get('/verifications/{daily_log}', [VerificationController::class, 'show'])->name('verifications.show');
        Route::post('/verifications/{daily_log}', [VerificationController::class, 'verify'])->name('verifications.verify');
    });
});
