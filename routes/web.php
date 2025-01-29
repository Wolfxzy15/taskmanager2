<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
Route::get('/', function () {
    $tasks = [];
    if (auth()->check()){
        $tasks = auth()->user()->Tasks()->latest()->get();
    }
    return view('home', ['tasks' => $tasks]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('login', [UserController::class, 'login']);
Route::post('/create-task', [TaskController::class, 'createTask']);
Route::get('/edit-task/{task}', [TaskController::class, 'showEditScreen']);
Route::put('/edit-task/{task}', [TaskController::class, 'updateTask']);
Route::delete('/delete-task/{task}', [TaskController::class, 'deleteTask']);
Route::put('/toggle-completed/{task}', [TaskController::class, 'toggleCompleted']);
