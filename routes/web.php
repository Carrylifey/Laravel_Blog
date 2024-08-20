<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [BlogController::class, 'index'])->middleware(['auth', 'verified'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
Route::get('/createblog', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/createblog', [BlogController::class, 'store'])->name('blogs.store');
});


require __DIR__.'/auth.php';
