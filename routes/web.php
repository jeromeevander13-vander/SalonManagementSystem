<?php

use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\TestimonialController;
use App\Models\Testimonial;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $testimonials = Testimonial::with('user')->where('is_visible', true)->latest()->get();
    return view('welcome', compact('testimonials'));
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
});
Route::get('/services', [services::class, 'index'])->name('services');
Route::view('/team', 'team')->name('team');
Route::view('/about', 'about')->name('about');
Route::view('/gallery', 'gallery')->name('gallery');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Admin Routes
    Route::middleware('can:acces-admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin_main');
        Route::get('/admin', [AdminController::class, "index"]);
        Route::get('/admin/edit/{appointment}', [AdminController::class, "edit"])->name('admin.edit');
        Route::put('/admin/update/{appointment}', [AdminController::class, "update"])->name('appointment.update');
        Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services');
        Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
        Route::post('/admin/services', [ServiceController::class, 'store'])->name('admin.services.store');
        Route::get('/admin/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
        Route::put('/admin/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
        Route::delete('/admin/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
        Route::get('/admin/clients', [AdminController::class, 'clients'])->name('admin.clients');
        Route::post('/admin/clients/{user}/ban', [AdminController::class, 'toggleBan'])->name('admin.clients.ban');
        Route::delete('/admin/clients/{user}', [AdminController::class, 'destroyClient'])->name('admin.clients.destroy');
        Route::get('/admin/invoices', [InvoiceController::class, 'index'])->name('admin.invoices');
        Route::get('/admin/inquiries', [InquiryController::class, 'index'])->name('admin.inquiries');
    });

    // Client Routes
    Route::get('/client/home', [ClientController::class, 'index'])->name('client_main');
    Route::get('/client/myappointments', [myappointments::class, 'index'])->name('client.appointments');
    Route::get('/client/invoices', [invoices::class, 'index'])->name('client.invoices');
    Route::get('/client/services', [services::class, 'index'])->name('client.services');
    Route::post('/client/appointment/{appointment}/cancel', [ClientController::class, 'cancel'])->name('client.appointment.cancel');
    
    Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/book-appointment', function() { return redirect()->route('client_main'); });
});

    // Unified Profile Management
    Route::middleware(['auth'])->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
            Route::delete('/profile', 'destroy')->name('profile.destroy');
        });
    });


require __DIR__.'/auth.php';