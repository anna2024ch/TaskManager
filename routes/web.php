<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Welcome page route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard and main feature routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Update the dashboard view path to match our structure
    Route::get('/dashboard', function () {
        return view('dashboard.index');  // Changed from just 'dashboard' to 'dashboard.index'
    })->name('dashboard');

    // Add project routes
    Route::get('/projects', function () {
        return view('projects.index');
    })->name('projects.index');

    // Add task routes
    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks.index');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
