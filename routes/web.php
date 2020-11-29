<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\logoutController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/Register', [RegisterController::class, 'index'])->name('Register');
Route::post('/Register', [RegisterController::class, 'store']);

Route::post('/logout', [logoutController::class, 'index'])->name("logout");

Route::get('/',[loginController::class, 'index'])->name('login');
Route::post('/', [loginController::class, 'store']);

Route::get('/Tasks', [TaskController::class, 'index'])->name('Tasks');
Route::post('/Tasks', [TaskController::class, 'store']);
Route::delete('/Tasks/{task}', [TaskController::class, 'destroy'])->name('Tasks.destroy');
Route::post('/Tasks/{task}', [TaskController::class, 'update'])->name('Tasks.update');
Route::post('/Tasks/Completed/{task}', [TaskController::class, 'finished'])->name('Tasks.finished');
// Route::post('/Tasks', [TaskController::class, 'search'])->name('Tasks.search');

Route::get('/Today', [TaskController::class, 'Today'])->name('Today');
Route::get('/Completed', [TaskController::class, 'Completed'])->name('Completed');
