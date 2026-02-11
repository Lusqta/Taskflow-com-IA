<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class,'index'])->name('index');

Route::resource('tasks', TaskController::class);
Route::patch('/tasks/{task}/move', [TaskController::class, 'move'])->name('tasks.move');
Route::post('/tasks/reorganize', [TaskController::class, 'reorganize'])->name('tasks.reorganize');
