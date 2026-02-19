<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    </style>
</head>
<body class="font-sans antialiased bg-midnight text-gray-200" x-data="{ currentTab: 'dashboard', mobileMenuOpen: false }">
    <div class="min-h-screen">
        <nav class="bg-black border-b border-red-900 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-14">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center md:hidden">
                            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-400 hover:text-white focus:outline-none">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-center space-x-2">
                            <span class="text-red-600 text-2xl font-bold italic">✂</span>
                            <span class="text-lg font-black tracking-tighter uppercase italic mobile-title-text">Tonet Salon Management System</span>
                        </div>

                        <div class="hidden md:flex space-x-1 ml-10 text-[10px] font-bold uppercase tracking-widest">
                            <button @click="currentTab = 'dashboard'" :class="currentTab === 'dashboard' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">DASHBOARD</button>
                            <button @click="currentTab = 'appointments'" :class="currentTab === 'appointments' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">APPOINTMENTS</button>
                            <button @click="currentTab = 'services'" :class="currentTab === 'services' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">SERVICES</button>
                            <button @click="currentTab = 'clients'" :class="currentTab === 'clients' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">CLIENTS</button>
                            <button @click="currentTab = 'reports'" :class="currentTab === 'reports' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">REPORTS</button>
                            <button @click="currentTab = 'inquiries'" :class="currentTab === 'inquiries' ? 'text-red-500 bg-red-950 bg-opacity-30 border border-red-900' : 'hover:text-red-500'" class="px-3 py-2 rounded flex items-center transition outline-none">INQUIRIES</button>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none group">
                                <span class="hidden sm:inline text-xs font-bold uppercase mr-2 text-gray-400 italic group-hover:text-red-500 transition">Admin</span>
                                <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center font-bold text-xs text-white border border-red-400 shadow-lg transition group-hover:scale-105">A</div>
                            </button>
                            <div x-show="dropdownOpen" x-transition class="absolute right-0 z-50 mt-2 w-48 rounded bg-card-dark border border-red-900 py-1" style="display: none;">
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

        
        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            
            <div x-show="currentTab === 'dashboard'">
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-white uppercase italic">Admin Dashboard</h1>
                    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">System Overview</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div class="bg-card-dark p-5 rounded border border-red-900 shadow-xl flex justify-between items-center">
                        <div><p class="text-4xl font-black text-white">0</p><p class="text-gray-500 text-[10px] font-bold uppercase">Total Customers</p></div>
                        <div class="text-red-900 text-3xl">👥</div>
                    </div>
                    <div class="bg-card-dark p-5 rounded border border-red-900 shadow-xl flex justify-between items-center">
                        <div><p class="text-4xl font-black text-white">0</p><p class="text-gray-500 text-[10px] font-bold uppercase">Total Appointments</p></div>
                        <div class="text-red-900 text-3xl">📅</div>
                    </div>
                    <div class="bg-card-dark p-5 rounded border border-red-900 shadow-xl flex justify-between items-center">
                        <div><p class="text-4xl font-black text-white">0</p><p class="text-gray-500 text-[10px] font-bold uppercase">Pending</p></div>
                        <div class="text-yellow-600 text-3xl">🕒</div>
                    </div>
                    <div class="bg-card-dark p-5 rounded border border-red-900 shadow-xl flex justify-between items-center">
                        <div><p class="text-4xl font-black text-white">0</p><p class="text-gray-500 text-[10px] font-bold uppercase">Total Services</p></div>
                        <div class="text-red-900 text-3xl">🌿</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 text-center">
                    <div class="bg-red-900 bg-opacity-20 p-6 rounded border border-red-900"><p class="text-2xl font-black text-white">$0.00</p><p class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Today's Sales</p></div>
                    <div class="bg-red-900 bg-opacity-20 p-6 rounded border border-red-900"><p class="text-2xl font-black text-white">$0.00</p><p class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Yesterday's Sales</p></div>
                    <div class="bg-red-900 bg-opacity-20 p-6 rounded border border-red-900"><p class="text-2xl font-black text-white">$0.00</p><p class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Last 7 Days Sales</p></div>
                    <div class="bg-red-900 bg-opacity-20 p-6 rounded border border-red-900"><p class="text-2xl font-black text-white">$0.00</p><p class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Total Sales</p></div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-card-dark rounded border border-red-900 p-6 shadow-2xl relative">
                        <div class="flex items-center text-white font-black uppercase italic text-xs mb-10 tracking-widest">
                            <span class="mr-2 text-red-600">📊</span> Sales Overview
                        </div>
                        <div class="relative h-64 w-full border-l border-b border-gray-800 chart-container">
                            <svg viewBox="0 0 1000 256" preserveAspectRatio="none" class="absolute inset-0 w-full h-full">
                                <polyline fill="none" stroke="#ef4444" stroke-width="4" points="0,256 333,256 666,256 1000,256" />
                            </svg>
                            <div class="absolute bottom-0 left-0 w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 translate-y-1.5 border-2 border-midnight"></div>
                            <div class="absolute bottom-0 left-1/3 w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 translate-y-1.5 border-2 border-midnight"></div>
                            <div class="absolute bottom-0 left-2/3 w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 translate-y-1.5 border-2 border-midnight"></div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-red-600 rounded-full translate-x-1.5 translate-y-1.5 border-2 border-midnight shadow-[0_0_10px_#ff0000]"></div>
                        </div>
                        <div class="flex justify-between mt-4 text-[9px] text-gray-500 font-bold uppercase italic tracking-widest">
                            <span>Today</span><span>Yesterday</span><span>Last 7 Days</span><span>Total</span>
                        </div>
                    </div>

                    <div class="bg-card-dark rounded border border-red-900 p-6 shadow-2xl">
                        <h3 class="font-black text-white uppercase italic text-sm tracking-widest mb-6">Quick Actions</h3>
                        <div class="space-y-6">
                            <div class="flex items-center text-yellow-500 text-[10px] font-bold uppercase">Review Pending Appointments <span class="ml-auto bg-yellow-600 text-black px-2 py-0.5 rounded font-black">0</span></div>
                            <div class="flex flex-col space-y-4 pt-2 border-l border-red-900 pl-4">
                                <a href="#" class="text-[10px] font-bold uppercase text-red-500 hover:text-white transition">+ Add New Service</a>
                                <a href="#" class="text-[10px] font-bold uppercase text-gray-400">👥 Manage Customers</a>
                                <a href="#" class="text-[10px] font-bold uppercase text-gray-400">📄 View Reports</a>
                                <a href="#" class="text-[10px] font-bold uppercase text-red-500 flex items-center">📧 New Inquiries <span class="ml-2 bg-red-600 text-white px-1.5 rounded text-[8px]">0</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 bg-card-dark rounded border border-red-900 overflow-hidden shadow-2xl">
                    <div class="bg-red-700 px-6 py-3 flex justify-between items-center">
                        <h3 class="font-black text-white uppercase italic text-xs tracking-widest">Recent Appointments</h3>
                        <button @click="currentTab = 'appointments'" class="text-white text-[10px] uppercase hover:underline font-black italic">View All</button>
                    </div>
                    <div class="p-20 text-center text-gray-700 font-bold uppercase text-[10px] tracking-[0.4em] italic">
                        No records found in system
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
                    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Registered Appointments: 0</p>
                </div>

                <div class="bg-card-dark border border-red-900 rounded p-4 mb-6 shadow-xl">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="w-full md:w-1/3">
                            <label class="block text-[10px] font-bold uppercase text-gray-500 mb-1">Filter Status</label>
                            <select class="w-full bg-midnight border border-red-900 text-gray-400 text-xs rounded px-3 py-2 outline-none">
                                <option>All Statuses</option>
                                <option>Pending</option>
                                <option>Completed</option>
                                <option>Accepted</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/3">
                            <label class="block text-[10px] font-bold uppercase text-gray-500 mb-1">Date</label>
                            <input type="date" class="w-full bg-midnight border border-red-900 text-gray-400 text-xs rounded px-3 py-2 outline-none">
                        </div>
                        <div class="flex gap-2">
                            <button class="bg-red-700 hover:bg-red-600 text-white text-[10px] font-black uppercase px-6 py-2.5 rounded transition">Filter</button>
                            <button class="bg-gray-800 hover:bg-gray-700 text-gray-400 text-[10px] font-black uppercase px-6 py-2.5 rounded transition">Clear</button>
                        </div>
                    </div>
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
                                    <th class="px-6 py-4">Date & Time</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($data as $datas)
                                <tr>
                                       
                                             <td  class=" text-center text-white font-bold uppercase text-[10px] tracking-[0.4em] italic">
                                                {{$datas->customer_name}}
                                            </td>
                                            <td  class=" text-center text-white font-bold uppercase text-[10px] tracking-[0.4em] italic">
                                                {{$datas->phone}}
                                            </td>
                                            <td  class=" text-center text-white font-bold uppercase text-[10px] tracking-[0.4em] italic">
                                                {{$datas->appointment_time}}
                                            </td>
                                            <td  class=" text-center text-white font-bold uppercase text-[10px] tracking-[0.4em] italic">
                                                {{$datas->status}}
                                            </td>
                                            <td  class=" text-center text-white font-bold uppercase text-[10px] tracking-[0.4em] italic">
                                                <a href="{{ route('admin.edit', $datas->id) }}" class="text-red-500 hover:text-red-400">Update</a> 
                                                
                                            </td>
                                        
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

    </div>
</body>
</html>