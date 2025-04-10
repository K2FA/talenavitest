<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

// Route for create Todo List
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');

// Route for chart data
Route::get('/chart', [TodoController::class, 'chart'])->name('chart');

// Route for export Todo List
Route::get("/todo/export", [TodoController::class, 'export'])->name('todo.export');
