<?php

use App\Http\Controllers\LoanController;
use App\Http\Controllers\RepaymentController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'createUser']);
Route::post('login', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->group(function (){

    Route::get('/user', function(Request $request){
        return $request->user();
    });

  Route::apiResource('loans', LoanController::class);  
Route::apiResource('repayments', RepaymentController::class);

Route::post('/logout', [AuthController::class, 'logoutUser']);

});



