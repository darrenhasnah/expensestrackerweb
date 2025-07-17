<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showAuth'])->name('auth');
    Route::get('/login', [AuthController::class, 'showAuth'])->name('login.form'); 
    Route::get('/register', [AuthController::class, 'showAuth'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ExpenseController::class, 'dashboard'])->name('dashboard');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::fallback(function () {
    return redirect()->route('auth');
});