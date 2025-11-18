<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ping', function () {
    return response.json(['response' => 'pong']);
});

Route::post('/tasks', [TaskController::class, 'store']);
