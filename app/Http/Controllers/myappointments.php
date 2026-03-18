<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class myappointments extends Controller
{
    //
    public function index() {
        $appointments = Appointment::where('email', Auth::user()->email)->get();
        dd($appointments); // Debug: check if appointments are fetched
        return view('client.myappointments', compact('appointments')); //
    }
}
