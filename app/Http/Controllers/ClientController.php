<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    //

    public function index()
    {
        $user_email = Auth::user()->email;
        $appointments = Appointment::with('service')
            ->where('email', $user_email)
            ->orderBy('appointment_time', 'desc')
            ->get();

        $services = \App\Models\Service::where('status', 'active')->get();

        // Helper function for price (consistent with AdminController)
        $getPrice = function ($appointment) {
            $service = $appointment->service;
            if ($service) {
                return (float) preg_replace('/[^0-9.]/', '', $service->price);
            }
            return 0;
        };

        // Metrics
        $totalAppointments = $appointments->count();
        
        $upcomingAppointmentsCount = $appointments->filter(function ($app) {
            return in_array(strtolower($app->status), ['pending', 'accepted']) && 
                   \Carbon\Carbon::parse($app->appointment_time)->isFuture();
        })->count();

        $totalSpent = $appointments->filter(function ($app) {
            return in_array(strtolower($app->status), ['completed', 'accepted']);
        })->sum($getPrice);

        $recentAppointments = $appointments->take(5);
        
        $nextVisit = $appointments->filter(function ($app) {
            return in_array(strtolower($app->status), ['pending', 'accepted']) && 
                   \Carbon\Carbon::parse($app->appointment_time)->isFuture();
        })->sortBy('appointment_time')->first();

        return view('client.dashboard', compact(
            'appointments', 
            'services', 
            'totalAppointments', 
            'upcomingAppointmentsCount', 
            'totalSpent',
            'recentAppointments',
            'nextVisit'
        ));
    }

    public function cancel(Appointment $appointment)
    {
        // Security check: ensure the appointment belongs to this client
        if ($appointment->email !== Auth::user()->email) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Only allow cancelling pending or accepted appointments
        if (in_array(strtolower($appointment->status), ['pending', 'accepted'])) {
            $appointment->status = 'cancelled';
            $appointment->save();
            return redirect()->back()->with('success', 'Appointment cancelled successfully.');
        }

        return redirect()->back()->with('error', 'This appointment cannot be cancelled.');
    }
}
