<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

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

        $user = User::where('role', 'admin')->get();
        
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
        
        $data = $query->get();
        $clients = User::where('role', 'client')->get();
        $services = \App\Models\Service::all();

        // Global Metrics (Not affected by current filter)
        $totalCustomers = $clients->count();
        $totalAppointmentsCount = Appointment::count();
        $pendingAppointmentsCountGlobal = Appointment::where('status', 'pending')->count();
        $totalServices = $services->count();

        // Sales Data (Using filtered data for trends, or global?)
        // Usually sales reports use the date filters but maybe not the status filters from the appointments table.
        // Let's use a separate query for sales if date filters are present.
        $salesQuery = Appointment::with('service');
        if ($startDate) $salesQuery->whereDate('appointment_time', '>=', $startDate);
        if ($endDate) $salesQuery->whereDate('appointment_time', '<=', $endDate);
        
        $salesData = $salesQuery->get();
        $completedAppointments = $salesData->filter(function($appointment) {
            return in_array(strtolower($appointment->status), ['completed', 'confirmed']);
        });

        $totalAppointments = $totalAppointmentsCount; // Use global for the overview card
        $pendingAppointmentsCount = $pendingAppointmentsCountGlobal;

        // Helper function to get clean numeric price from related service
        $getPrice = function($appointment) {
            $service = $appointment->service; // Assumes relationship 'service' exists
            if ($service) {
                return (float) preg_replace('/[^0-9.]/', '', $service->price);
            }
            return 0; // Fallback if no service is found
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

        // Client Report Data
        $clientReport = $clients->map(function($client) use ($data, $getPrice) {
            $clientAppointments = $data->where('email', $client->email);
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

        // Recent Appointments
        $recentAppointments = $data->take(5);

        return view("admin.dashboard", compact(
            "data", "user", "clients", "services",
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

    public function clients()
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.clients', compact('clients'));
    }

    public function destroyClient(User $user)
    {
        // Ensure we are only deleting clients, not admins
        if ($user->role !== 'client') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->route('admin_main')->with('success', 'Client deleted successfully.');
    }
}
