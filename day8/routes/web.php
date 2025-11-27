<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);       

Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword']);

Route::middleware('auth-sanctum')->group(function() {
    
   
});

 Route::get('/email/verify', [EmailVerificationController::class, 'verifyNotice'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verifyEmail'])->name('verification.verify');

    Route::get('/email/verification-notification', [EmailVerificationController::class, 'verifyHandler'])->middleware('throttle:6,1')->name('verification.send');



//instrcting the user to click to verify

