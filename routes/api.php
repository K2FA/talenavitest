<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('todo', TodoController::class)->only([
    'index',
    'store',
    'show',
    'update',
    'destroy'
]);
