<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;

Route::apiResource('todos', TodoController::class);

// Rota para restaurar um TODO que foi deletado
Route::patch('todos/{id}/restore', [TodoController::class, 'restore'])->name('todos.restore');
