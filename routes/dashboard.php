<?php
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/food', [DashboardController::class, 'food'])->middleware(['auth', 'verified'])->name('dashboard.food');