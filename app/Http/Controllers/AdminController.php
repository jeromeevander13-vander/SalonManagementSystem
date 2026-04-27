<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentConfirmed;
use App\Mail\AppointmentCancelled;
use App\Mail\NoShowAlert;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AccountBanned;
use App\Mail\AccountUnbanned;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    //
    public function index(Request $request)
    {   
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');
        $date = $request->input('date');
        $service_id = $request->input('service_id');

        $admins = User::where('role', 'admin')->get();
        
        $query = Appointment::with('service')->orderBy('appointment_time', 'desc');
        
        if ($startDate) {
            $query->whereDate('appointment_time', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('appointment_time', '<=', $endDate);
        }
        if ($status && $status !== 'All Statuses') {
            $query->where('status', $status);
        }
        if ($date) {
            $query->whereDate('appointment_time', $date);
        }
        if ($service_id && $service_id !== 'All Services') {
            $query->where('service_id', $service_id);
        }
        
        // All data for global metrics (affected by filters)
        $allData = $query->get();
        
        // Paginated data for Appointments Tab
        $data = $query->paginate(10, ['*'], 'appointmentsPage')->withQueryString();

        // Clients Data
        $allClients = User::where('role', 'client')->orderBy('name')->get();
        $clients = User::where('role', 'client')->orderBy('name')->paginate(10, ['*'], 'clientsPage')->withQueryString();
        
        $services = \App\Models\Service::latest()->get();

        // Global Metrics (Not affected by current filter)
        $totalCustomers = $allClients->count();
        $totalAppointmentsCount = Appointment::count();
        $pendingAppointmentsCountGlobal = Appointment::where('status', 'pending')->count();
        $totalServices = $services->count();

        // Sales Data
        $salesQuery = Appointment::with('service');
        if ($startDate) $salesQuery->whereDate('appointment_time', '>=', $startDate);
        if ($endDate) $salesQuery->whereDate('appointment_time', '<=', $endDate);
        
        $salesData = $salesQuery->get();
        $completedAppointments = $salesData->filter(function($appointment) {
            return in_array(strtolower($appointment->status), ['completed', 'confirmed']);
        });

        $totalAppointments = $totalAppointmentsCount; 
        $pendingAppointmentsCount = $pendingAppointmentsCountGlobal;

        $getPrice = function($appointment) {
            $service = $appointment->service;
            if ($service) {
                return (float) preg_replace('/[^0-9.]/', '', $service->price);
            }
            return 0;
        };

        $today = now()->startOfDay();
        $yesterday = now()->subDay()->startOfDay();
        $last7Days = now()->subDays(7)->startOfDay();

        $todaySales = $completedAppointments->filter(function ($app) use ($today) {
            return \Carbon\Carbon::parse($app->appointment_time)->gte($today);
        })->sum($getPrice);

        $yesterdaySales = $completedAppointments->filter(function ($app) use ($today, $yesterday) {
            $time = \Carbon\Carbon::parse($app->appointment_time);
            return $time->gte($yesterday) && $time->lt($today);
        })->sum($getPrice);

        $last7DaysSales = $completedAppointments->filter(function ($app) use ($last7Days) {
            return \Carbon\Carbon::parse($app->appointment_time)->gte($last7Days);
        })->sum($getPrice);

        $totalSales = $completedAppointments->sum($getPrice);

        // Client Report Data (Derived from paginated clients for the report view)
        // We use allData to ensure counts are accurate across all appointments
        $clientReport = $clients->getCollection()->map(function($client) use ($allData, $getPrice) {
            $clientAppointments = $allData->where('email', $client->email);
            return (object)[
                'name' => $client->name,
                'email' => $client->email,
                'appointments_count' => $clientAppointments->count(),
                'total_spent' => $clientAppointments->filter(function($app) {
                    return in_array(strtolower($app->status), ['completed', 'confirmed']);
                })->sum($getPrice)
            ];
        })->sortByDesc('total_spent');

        $day3agoSales = $completedAppointments->filter(function ($app) {
            $time = \Carbon\Carbon::parse($app->appointment_time);
            return $time->gte(now()->subDays(3)->startOfDay()) && $time->lt(now()->subDays(2)->startOfDay());
        })->sum($getPrice);

        $day2agoSales = $completedAppointments->filter(function ($app) {
            $time = \Carbon\Carbon::parse($app->appointment_time);
            return $time->gte(now()->subDays(2)->startOfDay()) && $time->lt(now()->subDays(1)->startOfDay());
        })->sum($getPrice);

        $chartData = [
            $day3agoSales,
            $day2agoSales,
            $yesterdaySales,
            $todaySales,
        ];

        $chartLabels = [
            now()->subDays(3)->format('M d'),
            now()->subDays(2)->format('M d'),
            'Yesterday',
            'Today',
        ];

        $recentAppointments = $allData->take(5);

        return view("admin.dashboard", compact(
            "data", "admins", "clients", "services",
            "totalCustomers", "totalAppointments", "pendingAppointmentsCount", "totalServices",
            "todaySales", "yesterdaySales", "last7DaysSales", "totalSales",
            "recentAppointments", "chartData", "chartLabels", "clientReport",
            "startDate", "endDate", "status", "date", "service_id"
        ));
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
            'appointment_time' => 'required',
            'status'           => 'required|string',
            'message'          => 'nullable|string',
            'service_type'     => 'nullable|string|max:255',
        ]);

        // Capture the previous status before updating
        $previousStatus = $appointment->status;
        $newStatus      = $request->status;

        // Combine Date + Time for your single DB column
        $fullTimestamp = $request->appointment_date . ' ' . $request->appointment_time;

        $appointment->update([
            'phone'            => $request->phone,
            'appointment_time' => $fullTimestamp,
            'status'           => $newStatus,
            'message'          => $request->message,
        ]);

        // Send email only when status actually changes
        if ($previousStatus !== $newStatus) {
            $appointment->load('service'); // ensure relationship is loaded

            if ($newStatus === 'confirmed') {
                Mail::to($appointment->email)->send(new AppointmentConfirmed($appointment));
            } elseif ($newStatus === 'cancelled') {
                Mail::to($appointment->email)->send(new AppointmentCancelled($appointment));
            } elseif ($newStatus === 'no-show') {
                // Find the user and increment no-show count
                $user = User::where('email', $appointment->email)->first();
                if ($user) {
                    $user->increment('no_show_count');
                }
                Mail::to($appointment->email)->send(new NoShowAlert($appointment));
            }
        }

        return redirect()->route('admin_main')->with('success', 'Appointment updated! Email notification sent to client.');
    }

    public function clients()
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.clients', compact('clients'));
    }

    public function toggleBan(User $user)
    {
        if ($user->role !== 'client') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        if ($user->is_banned) {
            Mail::to($user->email)->send(new AccountBanned($user));
        } else {
            Mail::to($user->email)->send(new AccountUnbanned($user));
        }

        $status = $user->is_banned ? 'banned' : 'unbanned';
        return redirect()->back()->with('success', "Client has been {$status} successfully. Email notification sent.");
    }

    public function destroyClient(User $user)
    {
        // Ensure we are only deleting clients, not admins
        if ($user->role !== 'client') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Client deleted successfully.');
    }
}
