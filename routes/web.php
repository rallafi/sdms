<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');

    Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('otp.form');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])
        ->middleware('throttle:5,1')
        ->name('otp.verify');
});

// Protected routes
Route::middleware(['auth', 'single.session'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Supervisor activity reports
    Route::get('/reports/activity', [ReportController::class, 'activityReport'])
        ->middleware('role:supervisor')
        ->name('reports.activity');

    // Document list and actions
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('documents.store');

    Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::post('/documents/{id}/reserve', [DocumentController::class, 'reserve'])
        ->middleware('throttle:10,1')
        ->name('documents.reserve');
    Route::post('/documents/{id}/release', [DocumentController::class, 'release'])
        ->middleware('throttle:10,1')
        ->name('documents.release');
    Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{id}', [DocumentController::class, 'update'])
        ->middleware('throttle:10,1')
        ->name('documents.update');
    Route::get('/documents/{id}', [DocumentController::class, 'show'])->name('documents.show');
});