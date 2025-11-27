<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ForgotPasswordController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



 Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class,'loginUser']);

Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);       

Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword']);


Route::middleware('auth:sanctum')->group(function (){

   Route::apiResource('loans', LoanController::class);
    Route::post('/logout', [AuthController::class,'logout']);

});

