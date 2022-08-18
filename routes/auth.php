<?php

use App\Http\Controllers;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {
    Route::get('register', [Auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [Auth\RegisteredUserController::class, 'store']);
    Route::get('login', [Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [Auth\AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [Auth\PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [Auth\NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [Auth\NewPasswordController::class, 'store'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [Auth\EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [Auth\VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [Auth\ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [Auth\ConfirmablePasswordController::class, 'store']);
    Route::post('logout', [Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Categories
    Route::resource('categories', Controllers\CategoryController::class);

    // Products
    Route::resource('products', Controllers\ProductController::class);

    // Profile
    Route::name('profile.')->prefix('profile')->group(function () {
        Route::get('user', [Controllers\ProfileController::class, 'showUserForm'])->name('user');
        Route::put('user', [Controllers\ProfileController::class, 'updateUser'])->name('user.update');
        Route::get('password', [Controllers\ProfileController::class, 'showPasswordForm'])->name('password');
        Route::put('password', [Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
    });
});
