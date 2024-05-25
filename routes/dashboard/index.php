<?php

use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

// Prefix dashboard is added in Route service provider
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/counter', Counter::class);