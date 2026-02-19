<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
public function store(Request $request)
{
    // Save to DB
    Appointment::create([
        'customer_name'    => auth()->user()->name,
        'email'            => auth()->user()->email,
        'phone'            => $request->phone,
        'service_type'     => $request->service_type,
        
        'appointment_time' => $request->appointment_date . ' ' . $request->appointment_time,
        'status'           => 'pending',
        'message'          => $request->message,
    ]);

    // FIX: Redirect back to the dashboard (a GET route)
    // Do NOT redirect to 'book-appointment'
    return redirect()->route('client_main')->with('success', 'Booking Successful!');
}

}
