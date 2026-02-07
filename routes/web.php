<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (No login required)
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Services Page
Route::get('/services', function () {
    return view('services');
})->name('services');

// Team Page
Route::get('/team', function () { 
    return view('team'); 
})->name('team');

// About Page (MOVED HERE)
Route::get('/about', function () {
    return view('about');
})->name('about');

// Add this to your public routes section
Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');


/*
|--------------------------------------------------------------------------
| Authenticated & Dashboard Routes (Login required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function() {
    
    // Admin Dashboard
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard')->middleware('can:acces-admin');

    // Client Dashboard
    Route::get('/client/dashboard', function() {
        return view('welcome');
    })->name('client')->middleware('can:acces-client');

    // Other Authenticated Pages
    Route::get('/main', function () {
        return view('main');
    })->name('main');

    Route::get('/new', function () {
        return view('new');
    })->name('new');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';