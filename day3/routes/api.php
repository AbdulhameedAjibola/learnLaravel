<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanPracticeController;
use App\Http\Controllers\LoanHandler;
use App\Http\Controllers\LoanRepaymentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/checkLoans', [LoanPracticeController::class, 'show']);

Route::get('/status-check', function(){
    return response()->json(['status' =>'endpoint active']);
});

Route::get('/loans', [LoanHandler::class, 'index']);           
Route::post('/loans', [LoanHandler::class, 'store']); 
         
Route::put('/loans/{id}', [LoanHandler::class, 'update']);     
Route::delete('/loans/{id}', [LoanHandler::class, 'destroy']);
Route::get('/loan-repayment', [LoanRepaymentController::class, 'index']);
Route::post('/loan-repayment/{loan_id}', [LoanRepaymentController::class, 'createRepayment']);
Route::put('/loan-repayment/{id}', [LoanRepaymentController::class, 'updateRepayment']); 
