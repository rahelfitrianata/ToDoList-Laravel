<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

Route::view('/register', 'auth.register')->name('register');
Route::view('/login', 'auth.login')->name('login');
Route::post('/register', [AuthController::class, 'store'])->name('register.post');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

Route::get('/dashboard', [TodoController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/tasks', [TodoController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{task}', [TodoController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TodoController::class, 'destroy'])->name('tasks.destroy');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/tasks/create', [TodoController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TodoController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TodoController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TodoController::class, 'update'])->name('tasks.update');
Route::get('/tasks/{id}/delete', [TodoController::class, 'confirmDelete'])->name('tasks.delete');
Route::get('/assignment-history', [TodoController::class, 'indexAssignment'])->name('assignment.history');