<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Food;

Route::get('/', function () {
    return view('front.home');
})->name('front.home');

Route::get('/food', function () {
    return view('front.food',[
        'foodItems' => \App\Models\Food::query()->orderByDesc('created_at')->paginate(10)
    ]);
})->name('front.food');

Route::get('/calculator', function () {
    return view('front.calculator');
})->name('front.calculator');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';