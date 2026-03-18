<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Tonet Salon MS</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Ensure the body doesn't hide the sticky nav context */
        html, body {
            height: 100%;
            scroll-padding-top: 4rem; /* Matches the height of your navbar */
        }

        .bg-midnight { background-color: #0a0a0a; }
        .bg-card-dark { background-color: #141414; }
        .border-red-900 { border-color: #450a0a; }
        
        .chart-container svg { width: 100%; height: 100%; }
        [x-cloak] { display: none !important; }

        /* Status Badge Styling for Appointments */
        .status-badge { font-size: 10px; font-weight: 900; text-transform: uppercase; padding: 2px 8px; border-radius: 4px; }
        .status-pending { background-color: #eab308; color: #000; }
        .status-completed { background-color: #06b6d4; color: #000; }
        .status-accepted { background-color: #16a34a; color: #fff; }
        
        input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); cursor: pointer; }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .mobile-title-text { font-size: 0.75rem; }
        }

        .white-icon { filter: brightness(0) invert(1); }
    </style>
</head>
<body class="font-sans antialiased bg-midnight text-gray-200" x-data="{ currentTab: localStorage.getItem('adminTab') || 'dashboard', mobileMenuOpen: false, showModal: false, selectedAppointment: {} }" x-init="$watch('currentTab', val => localStorage.setItem('adminTab', val))">
    <div class="min-h-screen flex flex-col">
        
        <nav class="sticky top-0 z-50 bg-black border-b border-red-900 text-white shadow-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center md:hidden">
                            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-400 hover:text-white focus:outline-none">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-center gap-3">
                            <img src="{{ asset('images/woman-with-long-hair.png') }}" class="w-8 h-8 white-icon">
                            <span class="text-lg font-black tracking-tighter uppercase italic mobile-title-text">Tonet Salon</span>
                        </div>

                        <div class="hidden md:flex space-x-1 ml-10 text-[10px] font-bold uppercase tracking-widest">
                            <button @click="currentTab = 'dashboard'" :class="currentTab === 'dashboard' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">DASHBOARD</button>
                            <button @click="currentTab = 'appointments'" :class="currentTab === 'appointments' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">APPOINTMENTS</button>
                            <button @click="currentTab = 'services'" :class="currentTab === 'services' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">SERVICES</button>
                            <button @click="currentTab = 'clients'" :class="currentTab === 'clients' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">CLIENTS</button>
                            <button @click="currentTab = 'reports'" :class="currentTab === 'reports' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">REPORTS</button>
                            
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none group">
                                <span class="hidden sm:inline text-xs font-bold uppercase mr-2 text-gray-400 italic group-hover:text-red-500 transition">Admin</span>
                                <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center font-bold text-xs text-white border border-red-400 shadow-lg transition group-hover:scale-105">A</div>
                            </button>
                            <div x-show="dropdownOpen" x-transition class="absolute right-0 z-50 mt-2 w-48 rounded bg-card-dark border border-red-900 py-1" x-cloak>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-900 hover:text-white font-bold transition">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="mobileMenuOpen" x-cloak class="md:hidden bg-black border-t border-red-900">
                <div class="px-2 pt-2 pb-3 space-y-1 text-[11px] font-bold uppercase tracking-widest">
                    <button @click="currentTab = 'dashboard'; mobileMenuOpen = false" class="block w-full text-left px-3 py-4 text-gray-300 hover:text-red-500 hover:bg-red-950 transition">DASHBOARD</button>
                    <button @click="currentTab = 'appointments'; mobileMenuOpen = false" class="block w-full text-left px-3 py-4 text-gray-300 hover:text-red-500 hover:bg-red-950 transition">APPOINTMENTS</button>
                    <button @click="currentTab = 'services'; mobileMenuOpen = false" class="block w-full text-left px-3 py-4 text-gray-300 hover:text-red-500 hover:bg-red-950 transition">SERVICES</button>
                    <button @click="currentTab = 'clients'; mobileMenuOpen = false" class="block w-full text-left px-3 py-4 text-gray-300 hover:text-red-500 hover:bg-red-950 transition">CLIENTS</button>
                    <button @click="currentTab = 'reports'; mobileMenuOpen = false" class="block w-full text-left px-3 py-4 text-gray-300 hover:text-red-500 hover:bg-red-950 transition">REPORTS</button>
                    <button @click="currentTab = 'inquiries'; mobileMenuOpen = false" class="block w-full text-left px-3 py-4 text-gray-300 hover:text-red-500 hover:bg-red-950 transition">INQUIRIES</button>
                </div>
            </div>
        </nav>

        <main class="max-w-[1600px] w-full mx-auto py-8 px-4 sm:px-6 lg:px-8 flex-grow">
            
            <div x-show="currentTab === 'dashboard'">
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-white uppercase italic">Admin Dashboard</h1>
                    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">System Overview</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div class="bg-card-dark p-5 rounded border border-red-900 shadow-xl flex justify-between items-center group hover:border-red-600 transition-colors">
                        <div><p class="text-4xl font-black text-white">{{ $totalCustomers }}</p><p class="text-gray-500 text-[10px] font-bold uppercase">Total Customers</p></div>
                        <div class="text-red-600">
                            <svg class="w-10 h-10 opacity-40 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-card-dark p-5 rounded border border-red-900 shadow-xl flex justify-between items-center group hover:border-red-600 transition-colors">
                        <div><p class="text-4xl font-black text-white">{{ $totalAppointments }}</p><p class="text-gray-500 text-[10px] font-bold uppercase">Total Appointments</p></div>
                        <div class="text-red-600">
                            <svg class="w-10 h-10 opacity-40 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-card-dark p-5 rounded border border-red-900 shadow-xl flex justify-between items-center group hover:border-yellow-600 transition-colors">
                        <div><p class="text-4xl font-black text-white">{{ $pendingAppointmentsCount }}</p><p class="text-gray-500 text-[10px] font-bold uppercase">Pending</p></div>
                        <div class="text-yellow-600">
                            <svg class="w-10 h-10 opacity-40 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-card-dark p-5 rounded border border-red-900 shadow-xl flex justify-between items-center group hover:border-red-600 transition-colors">
                        <div><p class="text-4xl font-black text-white">{{ $totalServices }}</p><p class="text-gray-500 text-[10px] font-bold uppercase">Total Services</p></div>
                        <div class="text-red-600">
                            <svg class="w-10 h-10 opacity-40 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758L5 19m0-14l4.121 4.121" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 text-center">
                    <div class="bg-red-900 bg-opacity-20 p-6 rounded border border-red-900"><p class="text-2xl font-black text-white">${{ number_format($todaySales, 2) }}</p><p class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Today's Sales</p></div>
                    <div class="bg-red-900 bg-opacity-20 p-6 rounded border border-red-900"><p class="text-2xl font-black text-white">${{ number_format($yesterdaySales, 2) }}</p><p class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Yesterday's Sales</p></div>
                    <div class="bg-red-900 bg-opacity-20 p-6 rounded border border-red-900"><p class="text-2xl font-black text-white">${{ number_format($last7DaysSales, 2) }}</p><p class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Last 7 Days Sales</p></div>
                    <div class="bg-red-900 bg-opacity-20 p-6 rounded border border-red-900"><p class="text-2xl font-black text-white">${{ number_format($totalSales, 2) }}</p><p class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Total Sales</p></div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-card-dark rounded border border-red-900 p-6 shadow-2xl relative">
                        <div class="flex items-center text-white font-black uppercase italic text-xs mb-10 tracking-widest">
                            <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg> Sales Trend
                        </div>
                        @php
                            $maxSales = max(max($chartData), 1);
                            $y1 = 256 - (($chartData[0] / $maxSales) * 236) - 10;
                            $y2 = 256 - (($chartData[1] / $maxSales) * 236) - 10;
                            $y3 = 256 - (($chartData[2] / $maxSales) * 236) - 10;
                            $y4 = 256 - (($chartData[3] / $maxSales) * 236) - 10;
                        @endphp
                        <div class="relative h-64 w-full border-l border-b border-gray-800 chart-container">
                            <svg viewBox="0 0 1000 256" preserveAspectRatio="none" class="absolute inset-0 w-full h-full">
                                <polyline fill="none" class="transition-all duration-1000" stroke="#ef4444" stroke-width="4" points="0,{{ $y1 }} 333,{{ $y2 }} 666,{{ $y3 }} 1000,{{ $y4 }}" />
                            </svg>
                            
                            <!-- Point 1 -->
                            <div class="absolute top-0 left-0 group" style="top: {{ $y1 }}px;">
                                <div class="w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 -translate-y-1.5 border-2 border-midnight transition-all duration-1000 group-hover:scale-150"></div>
                                <div class="absolute bottom-4 left-0 -translate-x-1/2 bg-red-900 bg-opacity-90 text-[8px] text-white px-2 py-0.5 rounded font-black whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity border border-red-500 shadow-lg z-10">
                                    ${{ number_format($chartData[0], 2) }}
                                </div>
                                <div class="absolute bottom-4 left-0 -translate-x-1/2 text-[8px] text-gray-400 font-bold whitespace-nowrap opacity-100 group-hover:opacity-0 transition-opacity">
                                    ${{ number_format($chartData[0], 0) }}
                                </div>
                            </div>

                            <!-- Point 2 -->
                            <div class="absolute top-0 left-1/3 group" style="top: {{ $y2 }}px;">
                                <div class="w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 -translate-y-1.5 border-2 border-midnight transition-all duration-1000 group-hover:scale-150"></div>
                                <div class="absolute bottom-4 left-0 -translate-x-1/2 bg-red-900 bg-opacity-90 text-[8px] text-white px-2 py-0.5 rounded font-black whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity border border-red-500 shadow-lg z-10">
                                    ${{ number_format($chartData[1], 2) }}
                                </div>
                                <div class="absolute bottom-4 left-0 -translate-x-1/2 text-[8px] text-gray-400 font-bold whitespace-nowrap opacity-100 group-hover:opacity-0 transition-opacity">
                                    ${{ number_format($chartData[1], 0) }}
                                </div>
                            </div>

                            <!-- Point 3 -->
                            <div class="absolute top-0 left-2/3 group" style="top: {{ $y3 }}px;">
                                <div class="w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 -translate-y-1.5 border-2 border-midnight transition-all duration-1000 group-hover:scale-150"></div>
                                <div class="absolute bottom-4 left-0 -translate-x-1/2 bg-red-900 bg-opacity-90 text-[8px] text-white px-2 py-0.5 rounded font-black whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity border border-red-500 shadow-lg z-10">
                                    ${{ number_format($chartData[2], 2) }}
                                </div>
                                <div class="absolute bottom-4 left-0 -translate-x-1/2 text-[8px] text-gray-400 font-bold whitespace-nowrap opacity-100 group-hover:opacity-0 transition-opacity">
                                    ${{ number_format($chartData[2], 0) }}
                                </div>
                            </div>

                            <!-- Point 4 -->
                            <div class="absolute top-0 right-0 group" style="top: {{ $y4 }}px;">
                                <div class="w-3 h-3 bg-red-600 rounded-full translate-x-1.5 -translate-y-1.5 border-2 border-midnight transition-all duration-1000 shadow-[0_0_10px_#ff0000] group-hover:scale-150"></div>
                                <div class="absolute bottom-4 right-0 translate-x-1/2 bg-red-900 bg-opacity-90 text-[8px] text-white px-2 py-0.5 rounded font-black whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity border border-red-500 shadow-lg z-10">
                                    ${{ number_format($chartData[3], 2) }}
                                </div>
                                <div class="absolute bottom-4 right-0 translate-x-1/2 text-[8px] text-gray-400 font-bold whitespace-nowrap opacity-100 group-hover:opacity-0 transition-opacity">
                                    ${{ number_format($chartData[3], 0) }}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-4 text-[9px] text-gray-500 font-bold uppercase italic tracking-widest">
                            <span>{{ $chartLabels[0] }}</span><span>{{ $chartLabels[1] }}</span><span>{{ $chartLabels[2] }}</span><span>{{ $chartLabels[3] }}</span>
                        </div>
                    </div>

                    <div class="bg-card-dark rounded border border-red-900 p-6 shadow-2xl">
                        <h3 class="font-black text-white uppercase italic text-sm tracking-widest mb-6">Quick Actions</h3>
                        <div class="space-y-6">
                            <div class="flex items-center text-yellow-500 text-[10px] font-bold uppercase">Review Pending Appointments <span class="ml-auto bg-yellow-600 text-black px-2 py-0.5 rounded font-black">{{ collect($data)->where('status', 'pending')->count() }}</span></div>
                            <div class="flex flex-col space-y-4 pt-2 border-l border-red-900 pl-4">
                                <a href="#" class="text-[10px] font-bold uppercase text-red-500 hover:text-white transition flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                    Add New Service
                                </a>
                                <a href="#" class="text-[10px] font-bold uppercase text-gray-400 hover:text-red-500 transition flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    Manage Customers
                                </a>
                                <a href="#" class="text-[10px] font-bold uppercase text-gray-400 hover:text-red-500 transition flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    View Reports
                                </a>
                                <a href="#" class="text-[10px] font-bold uppercase text-red-500 transition flex items-center group">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    New Inquiries <span class="ml-2 bg-red-600 text-white px-1.5 rounded text-[8px]">0</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 bg-card-dark rounded border border-red-900 overflow-hidden shadow-2xl">
                    <div class="bg-red-700 px-6 py-3 flex justify-between items-center">
                        <h3 class="font-black text-white uppercase italic text-xs tracking-widest">Recent Appointments</h3>
                        <button @click="currentTab = 'appointments'" class="text-white text-[10px] uppercase hover:underline font-black italic">View All</button>
                    </div>
                    <div class="p-0">
                        @if($recentAppointments->isEmpty())
                        <div class="p-20 text-center text-gray-700 font-bold uppercase text-[10px] tracking-[0.4em] italic">
                            No records found in system
                        </div>
                        @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b border-red-900 bg-midnight text-[9px] font-black uppercase tracking-widest text-red-500 italic">
                                        <th class="px-6 py-3">Customer</th>
                                        <th class="px-6 py-3">Service</th>
                                        <th class="px-6 py-3">Date & Time</th>
                                        <th class="px-6 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentAppointments as $appointment)
                                    <tr class="border-b border-red-900/10 hover:bg-white/5 transition-colors">
                                        <td class="px-6 py-3 text-white font-bold uppercase text-[10px] tracking-wider italic">
                                            {{ $appointment->customer_name }}
                                        </td>
                                        <td class="px-6 py-3 text-white font-bold uppercase text-[10px] tracking-wider italic">
                                            {{ $appointment->service?->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-3 text-white font-bold uppercase text-[10px] tracking-wider italic">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y h:i A') }}
                                        </td>
                                        <td class="px-6 py-3 text-white font-bold uppercase text-[10px] tracking-wider">
                                            <span class="status-badge status-{{ strtolower($appointment->status) }}">
                                                {{ $appointment->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div x-show="currentTab === 'services'" x-cloak>
                @include('admin.services')
            </div>

            <div x-show="currentTab === 'clients'" x-cloak>
                @include('admin.clients')
            </div>

            <div x-show="currentTab === 'reports'" x-cloak>
                @include('admin.reports')
            </div>

            <div x-show="currentTab === 'inquiries'" x-cloak>
                @include('admin.inquiries')
            </div>

            <div x-show="currentTab === 'appointments'" x-cloak>
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-white uppercase italic">Manage Appointments</h1>
                    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Registered Appointments: {{ $totalAppointments }}</p>
                </div>

                <div class="bg-card-dark border border-red-900 rounded p-4 mb-6 shadow-xl">
                    <form method="GET" action="{{ route('admin_main') }}" class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="w-full md:w-1/3">
                            <label class="block text-[10px] font-bold uppercase text-gray-500 mb-1">Filter Status</label>
                            <select name="status" class="w-full bg-midnight border border-red-900 text-gray-400 text-xs rounded px-3 py-2 outline-none uppercase font-bold tracking-widest">
                                <option value="All Statuses" {{ $status == 'All Statuses' ? 'selected' : '' }}>All Statuses</option>
                                <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="accepted" {{ $status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/3">
                            <label class="block text-[10px] font-bold uppercase text-gray-500 mb-1">Date</label>
                            <input type="date" name="date" value="{{ $date }}" class="w-full bg-midnight border border-red-900 text-gray-400 text-xs rounded px-3 py-2 outline-none uppercase font-bold tracking-widest">
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="bg-red-700 hover:bg-red-600 text-white text-[10px] font-black uppercase px-6 py-2.5 rounded transition shadow-lg">Filter</button>
                            <a href="{{ route('admin_main') }}" class="bg-gray-800 hover:bg-gray-700 text-gray-400 text-[10px] font-black uppercase px-6 py-2.5 rounded transition shadow-lg text-center flex items-center justify-center">Clear</a>
                        </div>
                    </form>
                </div>

                <div class="bg-card-dark border border-red-900 rounded shadow-2xl overflow-hidden">
                    <div class="bg-red-900 bg-opacity-40 border-b border-red-900 px-6 py-3">
                        <h3 class="font-black text-white uppercase italic text-[10px] tracking-[0.2em]">All Appointments</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-red-900 text-[10px] font-black uppercase tracking-widest text-red-500 italic">
                                    <th class="px-6 py-4">Customer</th>
                                    <th class="px-6 py-4">phone</th>
                                    <th class="px-6 py-4">Service</th>
                                    <th class="px-6 py-4">Date & Time</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                <tr class="border-b border-red-900/10 hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4 text-left text-white font-bold uppercase text-[10px] tracking-[0.2em] italic">
                                        {{$datas->customer_name}}
                                    </td>
                                    <td class="px-6 py-4 text-left text-white font-bold uppercase text-[10px] tracking-[0.2em] italic">
                                        {{$datas->phone}}
                                    </td>
                                    <td class="px-6 py-4 text-left text-white font-bold uppercase text-[10px] tracking-[0.2em] italic">
                                        {{$datas->service?->name ?? 'N/A'}}
                                    </td>
                                    <td class="px-6 py-4 text-left text-white font-bold uppercase text-[10px] tracking-[0.2em] italic">
                                        {{$datas->appointment_time}}
                                    </td>
                                    <td class="px-6 py-4 text-left text-white font-bold uppercase text-[10px] tracking-[0.2em] italic">
                                        {{$datas->status}}
                                    </td>
                                    <td class="px-6 py-4 text-right text-white font-bold uppercase text-[10px] tracking-[0.2em] italic">
                                        <button @click="selectedAppointment = { id: '{{ $datas->id }}', name: '{{ $datas->customer_name }}', phone: '{{ $datas->phone }}', status: '{{ $datas->status }}', message: '{{ $datas->message }}', date: '{{ date('Y-m-d', strtotime($datas->appointment_time)) }}', time: '{{ date('H:i:s', strtotime($datas->appointment_time)) }}' }; showModal = true" class="text-red-500 hover:text-red-400 cursor-pointer">Update</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <div x-show="showModal" 
             class="fixed inset-0 z-[60] overflow-y-auto flex items-center justify-center p-4" 
             x-cloak>
            
            <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity" @click="showModal = false"></div>

            <div class="relative w-full max-w-md bg-[#0a0a0a] border border-[#3a0a0a] rounded-xl p-8 shadow-2xl flex flex-col gap-6" @click.stop>
                
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Edit Session</h2>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-1">
                            Appointment ID: #<span x-text="selectedAppointment.id"></span>
                        </p>
                    </div>
                    <div class="border border-green-800 text-green-500 text-[9px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full bg-[#0a2e16]/30">
                        <span x-text="selectedAppointment.status"></span>
                    </div>
                </div>

                <form :action="'/admin/update/' + selectedAppointment.id" method="POST" class="flex flex-col gap-5">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Update Status</label>
                        <select name="status" x-model="selectedAppointment.status" class="w-full bg-[#111] border border-[#222] text-white text-sm rounded-lg px-4 py-3 outline-none focus:border-red-900 transition appearance-none">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-red-600 mb-2 tracking-widest">Date</label>
                            <input type="date" name="appointment_date" x-model="selectedAppointment.date" class="w-full bg-[#111] border border-[#222] text-white text-sm rounded-lg px-4 py-3 outline-none focus:border-red-900 transition">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-red-600 mb-2 tracking-widest">Time Slot</label>
                            <select name="appointment_time" x-model="selectedAppointment.time" class="w-full bg-[#111] border border-[#222] text-white text-sm rounded-lg px-4 py-3 outline-none focus:border-red-900 transition appearance-none">
                                <option value="09:00:00">09:00 AM</option>
                                <option value="10:30:00">10:30 AM</option>
                                <option value="13:00:00">01:00 PM</option>
                                <option value="15:30:00">03:30 PM</option>
                                <option value="17:00:00">05:00 PM</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Contact Number</label>
                        <input type="text" name="phone" x-model="selectedAppointment.phone" class="w-full bg-[#111] border border-[#222] text-white text-sm rounded-lg px-4 py-3 outline-none focus:border-red-900 transition">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Notes / Special Requests</label>
                        <textarea name="message" x-model="selectedAppointment.message" rows="3" class="w-full bg-[#111] border border-[#222] text-white text-sm rounded-lg px-4 py-3 outline-none focus:border-red-900 transition resize-none"></textarea>
                    </div>

                    <div class="mt-4 flex flex-col gap-4">
                        <button type="submit" class="w-full bg-[#b91c1c] hover:bg-red-700 text-white text-sm font-black uppercase tracking-widest py-4 rounded-lg transition shadow-lg">
                            Confirm Changes
                        </button>
                        <button type="button" @click="showModal = false" class="text-center text-[10px] font-bold uppercase text-gray-500 hover:text-white transition tracking-widest">
                            Discard and go back
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>
</html>