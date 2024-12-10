<?php

use App\Http\Controllers\WaiterController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Default login route
Route::get('/', function () {
    return view('auth.login');
});

// Profile management routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //data retrival
    Route::get('/get/menu-data', [DashboardController::class, 'getMenuData'])->name('get.menu-data');




});

require __DIR__ . '/auth.php';
