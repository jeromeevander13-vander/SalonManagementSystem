<?php

use App\Http\Controllers\admincontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\invoices;
use App\Http\Controllers\myappointments;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\services;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('welcome'); })->name('home');
Route::view('/services', 'services')->name('services');
Route::view('/team', 'team')->name('team');
Route::view('/about', 'about')->name('about');
Route::view('/gallery', 'gallery')->name('gallery');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function() {
    
    // SMART REDIRECT
    Route::get('/redirect', function() {
        if (Auth::user()->can('acces-admin')) {
            return redirect()->route('admin_main');
        }
        return redirect()->route('client_main');
    })->name('user.redirect');

    // Admin Dashboard
    // Route::get('/admin', function() { 
    //     return view('admin.dashboard'); 
    // })->name('admin_main')->middleware('can:acces-admin');

        Route::get('/admin', [admincontroller::class,"index"])->name('admin_main')->middleware('can:acces-admin');
        Route::get('/admin/edit/{appointment}', [admincontroller::class,"edit"])->name('admin.edit')->middleware('can:acces-admin');
        Route::put('/admin/update/{appointment}', [admincontroller::class,"update"])->name('appointment.update')->middleware('can:acces-admin');
    // The Dashboard (This is a GET route, it's safe to redirect here)

    Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services');
    Route::get('/admin/clients', [ClientController::class, 'index'])->name('admin.clients');
    Route::get('/admin/invoices', [InvoiceController::class, 'index'])->name('admin.invoices');
    Route::get('/admin/inquiries', [InquiryController::class, 'index'])->name('admin.inquiries');

Route::get('/client', function () { 
    return view('client.dashboard'); 
})->name('client_main')->middleware('can:acces-client');
     Route::get('/client/myappointments', [myappointments::class, 'index'])->name('client.appointments');
    Route::get('/client/invoices', [invoices::class, 'index'])->name('client.invoices');
    Route::get('/client/services', [services::class, 'index'])->name('client.services');



// The Booking Logic (This is POST only)
Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    // Profile Management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';