<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // App pages (blade shell) - React mounts into #app
    Route::get('/expenses', function () {
        return view('app', ['props' => ['user' => auth()->user()]]);
    })->name('expenses');

    Route::get('/loans', function () {
        return view('app', ['props' => ['user' => auth()->user()]]);
    })->name('loans');

    // catch-all for client-side routes under /app/*
    Route::get('/app/{any?}', function () {
        return view('app', ['props' => ['user' => auth()->user()]]);
    })->where('any', '.*');
});

require __DIR__.'/auth.php';
