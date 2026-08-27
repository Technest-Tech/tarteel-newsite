<?php

use App\Http\Controllers\AdminEnrollmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
| Public marketing site — a single page, plus the enrollment endpoint.
*/
Route::get('/', HomeController::class)->name('home');

Route::post('/enroll', [EnrollmentController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('enrollments.store');

/*
| Admin. Sign-in only: there is deliberately no registration route.
*/
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('admin.login.store');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Route::redirect (rather than a closure) keeps route:cache working.
    Route::redirect('/', '/admin/enrollments')->name('dashboard');
    Route::get('/enrollments', [AdminEnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('/enrollments/export', [AdminEnrollmentController::class, 'export'])->name('enrollments.export');
    Route::get('/enrollments/{enrollment}', [AdminEnrollmentController::class, 'show'])->name('enrollments.show');
    Route::patch('/enrollments/{enrollment}', [AdminEnrollmentController::class, 'update'])->name('enrollments.update');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});
