<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Beauty Parlor Management System</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .bg-midnight { background-color: #0a0a0a; }
        .bg-card-dark { background-color: #141414; }
        .border-red-900 { border-color: #450a0a; }
        
        .chart-container svg {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body class="font-sans antialiased bg-midnight text-gray-200">
    <div class="min-h-screen">
        <nav class="bg-black border-b border-red-900 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-14">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-red-600 text-2xl font-bold italic">✂</span>
                            <span class="text-lg font-black tracking-tighter uppercase italic">Tonet Salon Management System</span>
                        </div>
                        
                        <div class="hidden md:flex space-x-1 ml-10 text-[10px] font-bold uppercase tracking-widest">
                            <a href="#" class="text-red-500 bg-red-950 bg-opacity-30 px-3 py-2 rounded flex items-center border border-red-900">Dashboard</a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition">Appointments</a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition">Services</a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition">Customers</a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition">Invoices</a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition">Inquiries</a>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none group">
                                <span class="text-xs font-bold uppercase mr-2 text-gray-400 italic group-hover:text-red-500 transition">Admin</span>
                                <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center font-bold text-xs text-white border border-red-400 shadow-lg transition group-hover:scale-105">A</div>
                            </button>

                            <div x-show="dropdownOpen" 
                                 x-transition:enter="transition ease-out duration-100"
                                 class="absolute right-0 z-50 mt-2 w-48 rounded shadow-xl bg-card-dark border border-red-900 py-1" 
                                 style="display: none;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-900 hover:text-white font-bold transition" onclick="event.preventDefault(); this.closest('form').submit();">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
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
                        <div class="flex items-center text-yellow-500 text-[10px] font-bold uppercase">
                             Review Pending Appointments <span class="ml-auto bg-yellow-600 text-black px-2 py-0.5 rounded font-black">0</span>
                        </div>
                        <div class="flex flex-col space-y-4 pt-2 border-l border-red-900 pl-4">
                            <a href="#" class="text-[10px] font-bold uppercase text-red-500 hover:text-white transition">+ Add New Service</a>
                            <a href="#" class="text-[10px] font-bold uppercase text-gray-400 hover:text-red-500 transition">👥 Manage Customers</a>
                            <a href="#" class="text-[10px] font-bold uppercase text-gray-400 hover:text-red-500 transition">📄 View Reports</a>
                            <a href="#" class="text-[10px] font-bold uppercase text-red-500 flex items-center">
                                📧 New Inquiries <span class="ml-2 bg-red-600 text-white px-1.5 rounded text-[8px]">0</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-card-dark rounded border border-red-900 overflow-hidden shadow-2xl">
                <div class="bg-red-700 px-6 py-3 flex justify-between items-center">
                    <h3 class="font-black text-white uppercase italic text-xs tracking-widest">Recent Appointments</h3>
                    <a href="#" class="text-white text-[10px] uppercase hover:underline font-black italic">View All</a>
                </div>
                <div class="p-20 text-center text-gray-700 font-bold uppercase text-[10px] tracking-[0.4em] italic">
                    No records found in system
                </div>
            </div>
        </main>
    </div>
</body>
</html>