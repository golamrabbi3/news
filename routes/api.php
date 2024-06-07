<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\PasswordRecoveryController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\News\GuestNewsController;
use App\Http\Controllers\Api\News\NewsController;
use App\Http\Controllers\Api\Profile\EmailVerificationController;
use App\Http\Controllers\Api\Profile\LogoutController;
use App\Http\Controllers\Api\Profile\PasswordController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Roles\RolesController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::resource('news', GuestNewsController::class)->only('index', 'show');
    Route::post('register', RegisterController::class)->name('register');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('password-recovery', [PasswordRecoveryController::class, 'index'])
        ->middleware('throttle:3,1')
        ->name('password.recovery');
    Route::post('password-recovery/recover', [PasswordRecoveryController::class, 'recover'])
        ->middleware('throttle:3,1')
        ->name('password.recover');

    Route::prefix('user')->as('user.')->middleware('auth:sanctum')->group(function () {
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('profile/logout', LogoutController::class)->name('profile.logout');
        Route::post('profile/password', PasswordController::class)->name('password.update');
        Route::get('profile/email-verification', [EmailVerificationController::class, 'index'])
            ->middleware('throttle:3,1')
            ->name('email-verification.index');
        Route::post('profile/email-verification', [EmailVerificationController::class, 'verify'])
            ->middleware('throttle:3,1')
            ->name('email-verification.verify');
        Route::middleware('permission')->group(function () {
            Route::resource('roles', RolesController::class)->except('create', 'edit');
            Route::resource('news', NewsController::class)->except('create', 'edit');
        });
    });
});
