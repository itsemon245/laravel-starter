<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

// Prefix dashboard is added in Route service provider
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');