<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');

Route::get('/chart', [TodoController::class, 'chart'])->name('chart');
