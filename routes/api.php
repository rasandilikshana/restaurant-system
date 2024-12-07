<?php

use App\Http\Controllers\OrderController;
use Illuminate\Routing\Route;

Route::post('/orders', [OrderController::class, 'store']);
