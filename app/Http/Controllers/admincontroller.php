<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class admincontroller extends Controller
{
    //
    public function index()
    {
        $data = Appointment::get();
        return view("admin.dashboard", compact("data"));
    }

    public function edit(Appointment $appointment)
    {

        return view("admin.update", compact("appointment"));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'phone'            => 'required|string|max:20',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required', // This is the 09:00:00 string
            'status'           => 'required|string',
            'message'          => 'nullable|string',
            'service_type'     => 'nullable|string|max:255',
        ]);

        // Combine Date + Time for your single DB column
        $fullTimestamp = $request->appointment_date . ' ' . $request->appointment_time;

        $appointment->update([
            'phone'            => $request->phone,
            'appointment_time' => $fullTimestamp,
            'status'           => $request->status,
            'message'          => $request->message,
        ]);

        

        return redirect()->route('admin_main')->with('success', 'Appointment updated!');
    }
}
