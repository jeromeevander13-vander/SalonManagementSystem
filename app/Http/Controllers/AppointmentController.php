<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
public function store(Request $request)
{ 
    // Pre-validation: sanitize price
    if ($request->has('price')) {
        $cleanPrice = preg_replace('/[^0-9.]/', '', $request->price);
        $request->merge(['price' => $cleanPrice]);
    }

    $request->validate([
        'phone'            => 'required',
        'service_id'       => 'required|exists:services,id',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required',
        "message"          => 'nullable|string',
    ]);

    // 0. Ban Check
    if (Auth::user()->is_banned) {
        return redirect()->back()->with('error', 'Your booking privileges have been suspended. Please contact the salon for more information.');
    }

    // Anti-Spam Check: Limit pending appointments to 2 per user
    $pendingCount = Appointment::where('email', Auth::user()->email)
        ->where('status', 'pending')
        ->count();

    if ($pendingCount >= 2) {
        return redirect()->back()->withInput()->with('error', 'You already have 2 pending appointments. Please wait for the salon to confirm them before booking another one.');
    }

    // 1. Fetch Service and Calculate Proposed Time Slot
    $service = Service::findOrFail($request->service_id);
    $proposedStart = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);
    $proposedEnd = (clone $proposedStart)->addMinutes(($service->duration ?? 60) + 30); // Use 60 min default if null

    // 2. Overlap/Conflict Logic (for 2 Staff Members): 
    // We check if at any moment during the proposed slot, BOTH staff are busy.
    $overlappingApps = Appointment::with('service')
        ->where('status', '!=', 'cancelled')
        ->whereDate('appointment_time', $proposedStart->toDateString())
        ->get()
        ->filter(function($app) use ($proposedStart, $proposedEnd) {
            $existingStart = Carbon::parse($app->appointment_time);
            $existingDuration = ($app->service->duration ?? 60) + 30; // 30m buffer included
            $existingEnd = (clone $existingStart)->addMinutes($existingDuration);

            // True if existing appointment overlaps with our proposed window
            return $existingStart->lessThan($proposedEnd) && $existingEnd->greaterThan($proposedStart);
        });

    // If we have 2 or more overlapping appointments, we must check for a triple-booking
    if ($overlappingApps->count() >= 2) {
        $events = [];
        foreach ($overlappingApps as $app) {
            $s = Carbon::parse($app->appointment_time);
            $e = (clone $s)->addMinutes(($app->service->duration ?? 60) + 30);
            
            // We only care about the busy time WITHIN our proposed window
            $busyStart = $s->max($proposedStart);
            $busyEnd = $e->min($proposedEnd);
            
            if ($busyStart->lessThan($busyEnd)) {
                $events[] = ['time' => $busyStart, 'type' => 1];  // Staff becomes busy
                $events[] = ['time' => $busyEnd, 'type' => -1];   // Staff becomes free
            }
        }

        // Sort events by time. If times are equal, process "freed" staff (-1) before "busy" staff (+1)
        usort($events, function($a, $b) {
            if ($a['time']->equalTo($b['time'])) return $a['type'] - $b['type'];
            return $a['time']->lt($b['time']) ? -1 : 1;
        });

        $activeAppointments = 0;
        foreach ($events as $event) {
            $activeAppointments += $event['type'];
            if ($activeAppointments >= 2) { // Already 2 staff busy? Then 3rd (us) can't book.
                return redirect()->back()->withInput()->with('error', 'Triple booking conflict! Both our staff members are fully booked during part of this time. Please try a different slot.');
            }
        }
    }

    // 3. Create the record
    Appointment::create([
        'customer_name'    => Auth::user()->name,
        'email'            => Auth::user()->email,
        'phone'            => $request->phone,
        'service_id'       => $request->service_id,
        'appointment_time' => $proposedStart,
        'status'           => 'pending',
        'message'          => $request->message,
    ]);

    return redirect()->route('client_main')->with('success', 'Booking Successful! Please wait for confirmation..');
}
}