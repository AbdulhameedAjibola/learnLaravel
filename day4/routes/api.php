<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/create-user', [UserController::class, 'createUser']);
Route::post('/login-user', [UserController::class, 'loginUser']);



Route::middleware('auth:sanctum')->group(function () {

    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    
    Route::post('/logout', [UserController::class, 'logoutUser']);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('loans', LoanController::class);
});
