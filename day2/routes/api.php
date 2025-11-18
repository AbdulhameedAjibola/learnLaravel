<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanPracticeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/checkLoans', [LoanPracticeController::class, 'show']);

Route::get('/status-check', function(){
    return response()->json(['status' =>'endpoint active']);
});
