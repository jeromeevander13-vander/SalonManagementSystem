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

        /* Status Badge Styling for Appointments (Only for the Registry/Appointments Tab) */
        .status-badge { font-size: 9px; font-weight: 900; text-transform: uppercase; padding: 4px 12px; border-radius: 9999px; letter-spacing: 0.1em; display: inline-flex; align-items: center; justify-content: center; min-width: 80px; text-align: center; }
        .status-pending { background-color: #f59e0b; color: #fff; box-shadow: 0 0 10px rgba(245, 158, 11, 0.2); }
        .status-confirmed { background-color: #2563eb; color: #fff; box-shadow: 0 0 10px rgba(37, 99, 235, 0.2); }
        .status-completed { background-color: #16a34a; color: #fff; box-shadow: 0 0 10px rgba(22, 163, 74, 0.2); }
        .status-cancelled { background-color: #dc2626; color: #fff; box-shadow: 0 0 10px rgba(220, 38, 38, 0.2); }
        .status-no-show { background-color: #4b5563; color: #fff; box-shadow: 0 0 10px rgba(75, 85, 99, 0.2); }
        
        input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); cursor: pointer; }

        .white-icon { filter: brightness(0) invert(1); }

        /* Professional Pagination Styling */
        nav[role="navigation"] svg { width: 1.25rem; height: 1.25rem; }
        nav[role="navigation"] span, nav[role="navigation"] a { 
            background-color: #0c0c0c !important; 
            border-color: #1a1a1a !important; 
            color: #666 !important; 
            font-size: 10px !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            transition: all 0.3s ease !important;
        }
        nav[role="navigation"] a:hover { 
            background-color: #b91c1c !important; 
            color: white !important; 
            border-color: #ef4444 !important;
        }
        nav[role="navigation"] span[aria-current="page"] span { 
            background-color: #b91c1c !important; 
            color: white !important; 
            border-color: #ef4444 !important;
        }
    </style>
</head>
<body class="font-sans antialiased bg-midnight text-gray-200" x-data="{ currentTab: localStorage.getItem('adminTab') || 'dashboard', mobileMenuOpen: false, showModal: false, selectedAppointment: {} }" x-init="$watch('currentTab', val => localStorage.setItem('adminTab', val))">
    <div class="min-h-screen flex flex-col">
        
        <nav class="sticky top-0 z-50 bg-black border-b border-red-900 text-white shadow-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-8">
                        <div class="flex items-center">
                            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-400 hover:text-white mr-4 transition">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                                <img src="{{ asset('images/woman-with-long-hair.png') }}" class="w-8 h-8 white-icon transition group-hover:scale-110">
                                <span class="text-xl font-black tracking-tighter uppercase italic text-white">Tonet <span class="text-red-600">Salon</span></span>
                            </a>
                        </div>

                        <div class="hidden md:block h-6 w-[1px] bg-white/10"></div>

                        <div class="hidden md:flex space-x-1 text-[10px] font-bold uppercase tracking-widest">
                            <button @click="currentTab = 'dashboard'" :class="currentTab === 'dashboard' ? 'text-white bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.4)]' : 'text-gray-400 hover:text-white hover:bg-white/5'" class="px-4 py-2.5 rounded-lg transition-all duration-300">DASHBOARD</button>
                            <button @click="currentTab = 'appointments'" :class="currentTab === 'appointments' ? 'text-white bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.4)]' : 'text-gray-400 hover:text-white hover:bg-white/5'" class="px-4 py-2.5 rounded-lg transition-all duration-300">APPOINTMENTS</button>
                            <button @click="currentTab = 'services'" :class="currentTab === 'services' ? 'text-white bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.4)]' : 'text-gray-400 hover:text-white hover:bg-white/5'" class="px-4 py-2.5 rounded-lg transition-all duration-300">SERVICES</button>
                            <button @click="currentTab = 'clients'" :class="currentTab === 'clients' ? 'text-white bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.4)]' : 'text-gray-400 hover:text-white hover:bg-white/5'" class="px-4 py-2.5 rounded-lg transition-all duration-300">CLIENTS</button>
                            <button @click="currentTab = 'reports'" :class="currentTab === 'reports' ? 'text-white bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.4)]' : 'text-gray-400 hover:text-white hover:bg-white/5'" class="px-4 py-2.5 rounded-lg transition-all duration-300">REPORTS</button>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none group">
                                <div class="text-right mr-3 hidden sm:block">
                                    <p class="text-[9px] font-black uppercase tracking-widest text-red-600 leading-none">Administrator</p>
                                    <p class="text-[11px] font-bold text-gray-400 mt-0.5">Admin Account</p>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center font-black text-white border border-white/10 shadow-lg transition group-hover:scale-105 group-hover:rotate-3">A</div>
                            </button>
                            <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="absolute right-0 z-50 mt-4 w-56 rounded-2xl bg-[#111] border border-white/5 py-2 shadow-[0_20px_50px_rgba(0,0,0,0.5)] backdrop-blur-xl" x-cloak>
                                <div class="px-4 py-3 border-b border-white/5 mb-2">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-500">System Control</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center w-full text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white hover:bg-red-900/20 transition-all">Profile Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-red-500 hover:bg-red-900/20 transition-all">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                       Logout
                                    </button>
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
                    <div class="bg-card-dark p-6 rounded border border-red-900 shadow-xl flex flex-col justify-between group hover:border-red-600 transition-colors">
                        <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-2">Total Customers</p>
                        <h3 class="text-4xl font-black text-white italic tracking-tighter">{{ $totalCustomers }}</h3>
                    </div>
                    <div class="bg-card-dark p-6 rounded border border-red-900 shadow-xl flex flex-col justify-between group hover:border-red-600 transition-colors">
                        <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-2">Total Appointments</p>
                        <h3 class="text-4xl font-black text-white italic tracking-tighter">{{ $totalAppointments }}</h3>
                    </div>
                    <div class="bg-card-dark p-6 rounded border border-red-900 shadow-xl flex flex-col justify-between group hover:border-yellow-600 transition-colors">
                        <p class="text-yellow-600 text-[10px] font-black uppercase tracking-widest mb-2">Pending Sessions</p>
                        <h3 class="text-4xl font-black text-white italic tracking-tighter">{{ $pendingAppointmentsCount }}</h3>
                    </div>
                    <div class="bg-card-dark p-6 rounded border border-red-900 shadow-xl flex flex-col justify-between group hover:border-red-600 transition-colors">
                        <p class="text-red-600 text-[10px] font-black uppercase tracking-widest mb-2">Total Services</p>
                        <h3 class="text-4xl font-black text-white italic tracking-tighter">{{ $totalServices }}</h3>
                    </div>
                </div>

                <div class="mb-8 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-red-900/10 p-5 rounded border border-red-900/50 flex flex-col items-center">
                        <p class="text-2xl font-black text-white tracking-tighter uppercase italic">₱{{ number_format($todaySales, 2) }}</p>
                        <p class="text-red-500 text-[9px] font-bold uppercase tracking-[0.2em] mt-1">Today's Sales</p>
                    </div>
                    <div class="bg-red-900/10 p-5 rounded border border-red-900/50 flex flex-col items-center">
                        <p class="text-2xl font-black text-white tracking-tighter uppercase italic">₱{{ number_format($yesterdaySales, 2) }}</p>
                        <p class="text-red-500 text-[9px] font-bold uppercase tracking-[0.2em] mt-1">Yesterday's Sales</p>
                    </div>
                    <div class="bg-red-900/10 p-5 rounded border border-red-900/50 flex flex-col items-center">
                        <p class="text-2xl font-black text-white tracking-tighter uppercase italic">₱{{ number_format($last7DaysSales, 2) }}</p>
                        <p class="text-red-500 text-[9px] font-bold uppercase tracking-[0.2em] mt-1">Last 7 Days Sales</p>
                    </div>
                    <div class="bg-red-900/10 p-5 rounded border border-red-900/50 flex flex-col items-center">
                        <p class="text-2xl font-black text-white tracking-tighter uppercase italic">₱{{ number_format($totalSales, 2) }}</p>
                        <p class="text-red-500 text-[9px] font-bold uppercase tracking-[0.2em] mt-1">Total Sales</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <div class="lg:col-span-2 bg-card-dark rounded border border-red-900 p-6 shadow-2xl relative">
                        <div class="flex items-center text-white font-black uppercase italic text-xs mb-10 tracking-widest">
                            <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg> Sales Trend
                        </div>
                        @php
                            $maxSales = max(collect($chartData)->max(), 1);
                            $y1 = 256 - (($chartData[0] / $maxSales) * 236) - 10;
                            $y2 = 256 - (($chartData[1] / $maxSales) * 236) - 10;
                            $y3 = 256 - (($chartData[2] / $maxSales) * 236) - 10;
                            $y4 = 256 - (($chartData[3] / $maxSales) * 236) - 10;
                        @endphp
                        <div class="relative h-64 w-full border-l border-b border-gray-800 chart-container">
                            <svg viewBox="0 0 1000 256" preserveAspectRatio="none" class="absolute inset-0 w-full h-full">
                                <polyline fill="none" class="transition-all duration-1000" stroke="#ef4444" stroke-width="4" points="0,{{ $y1 }} 333,{{ $y2 }} 666,{{ $y3 }} 1000,{{ $y4 }}" />
                            </svg>
                            
                            <div class="absolute top-0 left-0 group" style="top: {{ $y1 }}px;"><div class="w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 -translate-y-1.5 border-2 border-midnight"></div></div>
                            <div class="absolute top-0 left-1/3 group" style="top: {{ $y2 }}px;"><div class="w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 -translate-y-1.5 border-2 border-midnight"></div></div>
                            <div class="absolute top-0 left-2/3 group" style="top: {{ $y3 }}px;"><div class="w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 -translate-y-1.5 border-2 border-midnight"></div></div>
                            <div class="absolute top-0 right-0 group" style="top: {{ $y4 }}px;"><div class="w-3 h-3 bg-red-600 rounded-full translate-x-1.5 -translate-y-1.5 border-2 border-midnight"></div></div>
                        </div>
                        <div class="flex justify-between mt-4 text-[9px] text-gray-500 font-bold uppercase tracking-widest italic">
                            <span>{{ $chartLabels[0] }}</span><span>{{ $chartLabels[1] }}</span><span>{{ $chartLabels[2] }}</span><span>{{ $chartLabels[3] }}</span>
                        </div>
                    </div>

                    <div class="bg-card-dark rounded border border-red-900 p-6 shadow-2xl">
                        <h3 class="font-black text-white uppercase italic text-sm tracking-widest mb-6">Quick Actions</h3>
                        <div class="space-y-6">
                            <div class="flex items-center text-yellow-500 text-[10px] font-bold uppercase">System Status: Active</div>
                            <div class="flex flex-col space-y-4 pt-2 border-l border-red-900 pl-4">
                                <button @click="currentTab = 'services'" class="text-[10px] font-bold uppercase text-red-500 hover:text-white transition text-left flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                    Add New Service
                                </button>
                                <button @click="currentTab = 'clients'" class="text-[10px] font-bold uppercase text-gray-400 hover:text-red-500 transition text-left flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    Manage Customers
                                </button>
                                <button @click="currentTab = 'reports'" class="text-[10px] font-bold uppercase text-gray-400 hover:text-red-500 transition text-left flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    View Reports
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-card-dark rounded border border-red-900 overflow-hidden shadow-2xl">
                    <div class="bg-red-700 px-6 py-3 flex justify-between items-center">
                        <h3 class="font-black text-white uppercase italic text-xs tracking-widest">Recent Activity</h3>
                        <button @click="currentTab = 'appointments'" class="text-white text-[10px] uppercase hover:underline font-black italic">View Full Stream</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-red-900 bg-midnight text-[9px] font-black uppercase tracking-widest text-red-500 italic">
                                    <th class="px-6 py-3">Customer</th>
                                    <th class="px-6 py-3">Service</th>
                                    <th class="px-6 py-3">Timing</th>
                                    <th class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentAppointments as $appointment)
                                <tr class="border-b border-red-900/10 hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-3 text-white font-bold uppercase text-[10px] tracking-wider italic">{{ $appointment->customer_name }}</td>
                                    <td class="px-6 py-3 text-white font-bold uppercase text-[10px] tracking-wider italic">{{ $appointment->service?->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-3 text-gray-400 font-bold text-[10px] tracking-wider italic">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('M d, h:i A') }}</td>
                                    <td class="px-6 py-3 text-white font-black uppercase text-[10px] tracking-widest italic opacity-70">{{ $appointment->status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

            <div x-show="currentTab === 'appointments'" x-cloak>
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-white uppercase italic">Manage Appointments</h1>
                    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Registered Appointments: {{ $totalAppointments }}</p>
                </div>

                <div class="bg-card-dark border border-red-900 rounded p-4 mb-6 shadow-xl">
                    <form method="GET" action="{{ route('admin_main') }}" class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="w-full md:w-1/4">
                            <label class="block text-[10px] font-bold uppercase text-gray-500 mb-1 tracking-widest">Status</label>
                            <select name="status" class="w-full bg-midnight border border-red-900 text-gray-400 text-xs rounded px-3 py-2.5 outline-none uppercase font-bold tracking-widest focus:border-red-600 transition">
                                <option value="All Statuses" {{ $status == 'All Statuses' ? 'selected' : '' }}>All Statuses</option>
                                <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="no-show" {{ $status == 'no-show' ? 'selected' : '' }}>No-Show</option>
                                <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/4">
                            <label class="block text-[10px] font-bold uppercase text-gray-500 mb-1 tracking-widest">Service</label>
                            <select name="service_id" class="w-full bg-midnight border border-red-900 text-gray-400 text-xs rounded px-3 py-2.5 outline-none uppercase font-bold tracking-widest focus:border-red-600 transition">
                                <option value="All Services" {{ $service_id == 'All Services' ? 'selected' : '' }}>All Services</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ $service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="bg-red-700 hover:bg-red-600 text-white text-[10px] font-black uppercase px-6 py-3 rounded transition shadow-lg">Filter</button>
                            <a href="{{ route('admin_main') }}" class="bg-gray-800 hover:bg-gray-700 text-gray-400 text-[10px] font-black uppercase px-6 py-3 rounded transition shadow-lg text-center flex items-center justify-center">Clear</a>
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
                                    <th class="px-6 py-4">Phone</th>
                                    <th class="px-6 py-4">Service</th>
                                    <th class="px-6 py-4">Date & Time</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                <tr class="border-b border-red-900/10 hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4 text-left text-white font-bold uppercase text-[10px] tracking-[0.2em] italic">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full overflow-hidden border border-red-900 bg-black flex items-center justify-center">
                                                @if($datas->user?->avatar)
                                                    <img src="{{ asset('storage/' . $datas->user->avatar) }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ substr($datas->customer_name, 0, 1) }}
                                                @endif
                                            </div>
                                            {{$datas->customer_name}}
                                        </div>
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
                                    <td class="px-6 py-4 text-center">
                                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $datas->status)) }}">
                                            {{ $datas->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-white font-bold uppercase text-[10px] tracking-[0.2em] italic">
                                        <button @click="selectedAppointment = { id: '{{ $datas->id }}', name: '{{ $datas->customer_name }}', phone: '{{ $datas->phone }}', status: '{{ $datas->status }}', message: '{{ $datas->message }}', date: '{{ date('Y-m-d', strtotime($datas->appointment_time)) }}', time: '{{ date('H:i:s', strtotime($datas->appointment_time)) }}' }; showModal = true" class="text-red-500 hover:text-red-400 cursor-pointer">Update</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 px-6 pb-6">
                        {{ $data->links() }}
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
                        <h2 class="text-3xl font-black text-white uppercase tracking-tighter text-left">Edit Session</h2>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-1 text-left">
                            Appointment ID: #<span x-text="selectedAppointment.id"></span>
                        </p>
                    </div>
                </div>

                <form :action="'/admin/update/' + selectedAppointment.id" method="POST" class="flex flex-col gap-5 text-left">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Update Status</label>
                        <select name="status" x-model="selectedAppointment.status" class="w-full bg-[#111] border border-[#222] text-white text-sm rounded-lg px-4 py-3 outline-none focus:border-red-900 transition appearance-none">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="no-show">No-Show</option>
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
                                <option value="10:00:00">10:00 AM</option>
                                <option value="11:00:00">11:00 AM</option>
                                <option value="12:00:00">12:00 PM</option>
                                <option value="13:00:00">01:00 PM</option>
                                <option value="14:00:00">02:00 PM</option>
                                <option value="15:00:00">03:00 PM</option>
                                <option value="16:00:00">04:00 PM</option>
                                <option value="17:00:00">05:00 PM</option>
                                <option value="18:00:00">06:00 PM</option>
                                <option value="19:00:00">07:00 PM</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Contact Number</label>
                        <input type="text" name="phone" x-model="selectedAppointment.phone" class="w-full bg-[#111] border border-[#222] text-white text-sm rounded-lg px-4 py-3 outline-none focus:border-red-900 transition">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Notes</label>
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