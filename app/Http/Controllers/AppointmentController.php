<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
  
public function store(Request $request)
{
    \App\Models\Appointment::create([
        'customer_name'    => Auth::user()->name, 
        'email'            => Auth::user()->email,
        'phone'            => $request->phone,
        'service_type'     => $request->service_type,
        'appointment_time' => $request->appointment_date . ' ' . $request->appointment_time,
        'status'           => 'pending',
        'message'          => $request->message,
    ]);

    return response()->json(['message' => 'Appointment booked!']);
}

}