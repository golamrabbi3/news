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
    Route::post('register', RegisterController::class);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('password-recovery', [PasswordRecoveryController::class, 'index']);
    Route::post('password-recovery/recover', [PasswordRecoveryController::class, 'recover']);

    Route::prefix('user')->middleware('auth:sanctum')->group(function () {
        Route::get('profile', [ProfileController::class, 'show']);
        Route::post('profile', [ProfileController::class, 'update']);
        Route::get('profile/logout', LogoutController::class);
        Route::post('profile/password', PasswordController::class);
        Route::get('profile/email-verification', [EmailVerificationController::class, 'index'])
            ->middleware('throttle:1,2');
        Route::post('profile/email-verification', [EmailVerificationController::class, 'verify'])
            ->middleware('throttle:3,1');
        Route::middleware('permission')->group(function () {
            Route::resource('roles', RolesController::class)->except('create', 'edit');
            Route::resource('news', NewsController::class)->except('create', 'edit');
        });
    });
});
