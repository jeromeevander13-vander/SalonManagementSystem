<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tonet Salon Management System</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @php
    $servicesArray = $services->map(function($service) {
        return [
            'id' => $service->id,
            'category' => 'SERVICES',
            'name' => $service->name,
            'price' => $service->price,
            'duration' => $service->duration ? $service->duration . ' mins' : 'N/A',
            'img' => $service->image ? (str_starts_with($service->image, 'services/') ? \Illuminate\Support\Facades\Storage::disk('s3')->url($service->image) : asset($service->image)) : asset('images/service.jpg'),
            'desc' => $service->description ?? 'Professional service',
            'sessions' => null
        ];
    })->toArray();
    @endphp
    <script>
        window.servicesData = @json($servicesArray);
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .bg-dark-home { background-color: #121212; }
        .bg-card-dark { background-color: #1e1e1e; }
        .border-dark-red { border-color: #3d0a0a; }
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 10px; }
        input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); }

        .session-info {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.4s ease-in-out;
        }
        .price-container:hover .session-info {
            max-height: 100px;
            opacity: 1;
            margin-top: 0.5rem;
        }

        @media (max-width: 640px) {
            .mobile-title { font-size: 0.75rem !important; line-height: 1.2; }
        }

        .status-badge { font-size: 10px; font-weight: 900; text-transform: uppercase; padding: 2px 8px; border-radius: 4px; }
        .status-pending { background-color: #eab308; color: #000; }
        .status-completed { background-color: #06b6d4; color: #000; }
        .status-accepted { background-color: #16a34a; color: #fff; }
        .status-cancelled { background-color: #ef4444; color: #fff; }

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
<body class="font-sans antialiased bg-dark-home text-gray-200" x-data="{
    currentTab: localStorage.getItem('clientTab') || 'dashboard',
    mobileMenuOpen: false,
    appointments: [],
    showModal: {{ $errors->any() ? 'true' : 'false' }},
    showDetailsModal: false,
    selectedAppointment: null,
    step: {{ $errors->any() ? 2 : 1 }},
    selectedService: '',
    selectedPrice: '',
    selectedDuration: '',
    bookingData: {
        service_id: {{ json_encode(old('service_id', '')) }},
        date: {{ json_encode(old('appointment_date', '')) }},
        time: {{ json_encode(old('appointment_time', '09:00:00')) }},
        phone: {{ json_encode(old('phone', '')) }},
        message: {{ json_encode(old('message', '')) }},
        price: {{ json_encode(old('price', '')) }}
    },
    services: window.servicesData || [],
    selectService(id, name, price, duration) {
        this.selectedService = name;
        this.selectedPrice = price;
        this.selectedDuration = duration;
        this.bookingData.service_id = id;
        this.bookingData.price = price;
        this.step = 2;
    }
}" x-init="
    console.log('Alpine.js loaded', services);
    if (bookingData.service_id) {
        const svc = services.find(s => s.id == bookingData.service_id);
        if (svc) {
            selectedService = svc.name;
            selectedPrice = svc.price;
            selectedDuration = svc.duration;
        }
    }
    $watch('currentTab', val => localStorage.setItem('clientTab', val))
">
    <div class="min-h-screen">
        <nav class="sticky top-0 z-50 bg-black border-b border-red-900 text-white shadow-lg backdrop-blur-md bg-opacity-95">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-14">
                    <div class="flex items-center gap-8">
                        <div class="flex items-center">
                            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-400 hover:text-red-500 focus:outline-none mr-4 transition">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                                <img src="{{ asset('images/woman-with-long-hair.png') }}" class="w-8 h-8 white-icon transition group-hover:scale-110">
                                <span class="text-xl font-black tracking-tighter uppercase italic text-white leading-none">Tonet <span class="text-red-600">Salon</span></span>
                            </a>
                        </div>

                        <div class="hidden md:block h-6 w-[1px] bg-white/10"></div>

                        <div class="hidden md:flex items-center space-x-1 text-[10px] font-bold uppercase tracking-widest">
                            <a href="#" @click.prevent="currentTab = 'dashboard'" :class="currentTab === 'dashboard' ? 'text-white bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.4)]' : 'text-gray-400 hover:text-white hover:bg-white/5 border border-transparent'" class="px-4 py-2.5 rounded-lg transition-all duration-300 flex items-center">Dashboard</a>
                            <a href="#" @click.prevent="currentTab = 'myappointments'" :class="currentTab === 'myappointments' ? 'text-white bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.4)]' : 'text-gray-400 hover:text-white hover:bg-white/5 border border-transparent'" class="px-4 py-2.5 rounded-lg transition-all duration-300 flex items-center">My Appointments</a>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none group">
                                <div class="text-right mr-3 hidden sm:block">
                                    <p class="text-[9px] font-black uppercase tracking-widest text-red-600 leading-none">Client Portal</p>
                                    <p class="text-[11px] font-bold text-gray-400 mt-0.5">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-red-900 overflow-hidden flex items-center justify-center font-black text-white border border-white/10 shadow-lg transition group-hover:scale-105 group-hover:-rotate-3">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ str_starts_with(Auth::user()->avatar, 'avatars/') ? \Illuminate\Support\Facades\Storage::disk('s3')->url(Auth::user()->avatar) : asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    @endif
                                </div>
                                <svg class="ms-1 fill-current h-4 w-4 text-red-600 transition-transform group-hover:translate-y-0.5" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg>
                            </button>
                            <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="absolute right-0 z-50 mt-4 w-56 rounded-2xl bg-[#0f0f0f] border border-white/5 py-2 shadow-[0_20px_50px_rgba(0,0,0,0.5)] backdrop-blur-xl" x-cloak>
                                <div class="px-4 py-3 border-b border-white/5 mb-2">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-500">Account Options</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-[10px] font-black uppercase tracking-widest text-gray-300 hover:bg-white/5 hover:text-white transition-all">
                                    <svg class="w-4 h-4 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    Profile Settings
                                </a>
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
            <div x-show="mobileMenuOpen" x-cloak class="md:hidden bg-black border-t border-red-900 px-4 py-2 space-y-1">
                <a href="#" @click.prevent="currentTab = 'dashboard'; mobileMenuOpen = false" class="block px-3 py-4 text-xs font-bold uppercase tracking-widest text-gray-300 hover:text-red-500">Dashboard</a>
                <a href="#" @click.prevent="currentTab = 'myappointments'; mobileMenuOpen = false" class="block px-3 py-4 text-xs font-bold uppercase tracking-widest text-gray-300 hover:text-red-500">My Appointments</a>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div x-show="currentTab === 'dashboard'" x-cloak>
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-white uppercase italic">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-red-500 font-medium tracking-wide">Manage your appointments and beauty treatments.</p>
                </div>

                @if(session('success'))
                <div class="mb-6 p-4 bg-green-900/20 border border-green-900 rounded text-green-500 text-xs font-bold uppercase tracking-widest flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-900/20 border border-red-900 rounded text-red-500 text-xs font-bold uppercase tracking-widest flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ session('error') }}
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-card-dark p-6 rounded border border-red-900 flex justify-between items-center shadow-2xl group hover:border-red-600 transition-colors">
                        <div><p class="text-5xl font-black text-white">{{ $totalAppointments }}</p><p class="text-gray-400 text-xs font-bold uppercase mt-1">Total Appointments</p></div>
                        <div class="text-red-600">
                             <svg class="w-10 h-10 opacity-40 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-card-dark p-6 rounded border border-red-900 flex justify-between items-center shadow-2xl group hover:border-yellow-600 transition-colors">
                        <div><p class="text-5xl font-black text-white">{{ $upcomingAppointmentsCount }}</p><p class="text-gray-400 text-xs font-bold uppercase mt-1">Upcoming Visits</p></div>
                        <div class="text-yellow-500">
                            <svg class="w-10 h-10 opacity-40 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg-card-dark p-6 rounded border border-red-900 flex justify-between items-center shadow-2xl group hover:border-green-600 transition-colors">
                        <div><p class="text-5xl font-black text-white">₱{{ number_format($totalSpent, 2) }}</p><p class="text-gray-400 text-xs font-bold uppercase mt-1">Total Spent</p></div>
                        <div class="text-green-600">
                            <svg class="w-10 h-10 opacity-40 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        @if($nextVisit)
                        <div class="bg-card-dark p-8 rounded border border-yellow-900 shadow-2xl border-l-4 border-l-yellow-600 relative overflow-hidden group">
                             <!-- Decorative Background SVG -->
                             <svg class="absolute -right-4 -bottom-4 w-32 h-32 text-yellow-600 opacity-5 group-hover:opacity-10 transition-opacity" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>

                             <div class="flex items-center justify-between">
                                 <div>
                                     <div class="flex items-center space-x-2 mb-2">
                                         <span class="bg-yellow-600 text-black text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-widest animate-pulse">Next Up</span>
                                         <p class="text-gray-500 text-[9px] font-bold uppercase tracking-widest">ID: #{{ $nextVisit->id }}</p>
                                     </div>
                                     <h3 class="text-2xl font-black text-white uppercase italic tracking-tighter">{{ $nextVisit->service ? $nextVisit->service->name : ($nextVisit->service_type ?? 'N/A') }}</h3>
                                     <div class="flex items-center space-x-4 mt-2">
                                         <div class="flex items-center text-yellow-500">
                                              <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                              <span class="text-[10px] font-black uppercase tracking-widest">{{ \Carbon\Carbon::parse($nextVisit->appointment_time)->format('M d, Y') }}</span>
                                         </div>
                                         <div class="flex items-center text-yellow-500">
                                              <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                              <span class="text-[10px] font-black uppercase tracking-widest">{{ \Carbon\Carbon::parse($nextVisit->appointment_time)->format('h:i A') }}</span>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="text-right flex flex-col items-end">
                                     <div class="status-badge status-{{ strtolower($nextVisit->status) }} mb-4 scale-110">{{ $nextVisit->status }}</div>
                                     <div class="flex items-center space-x-2">
                                         <button @click="currentTab = 'myappointments'" class="bg-white text-black text-[10px] font-black px-6 py-2 uppercase rounded hover:bg-yellow-600 transition shadow-xl">Details</button>
                                         <form action="{{ route('client.appointment.cancel', $nextVisit) }}" method="POST" onsubmit="return confirm('Magic sessions are precious. Are you sure you want to cancel?')">
                                             @csrf
                                             <button type="submit" class="bg-red-900 text-white text-[10px] font-black px-6 py-2 uppercase rounded hover:bg-white hover:text-red-900 transition shadow-xl">Cancel</button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                        </div>
                        @else
                        <div class="bg-card-dark p-12 rounded border border-red-900 flex flex-col items-center justify-center text-center shadow-2xl">
                            <div class="w-20 h-20 rounded-full mb-6 flex items-center justify-center text-red-600 text-4xl font-bold border-2 border-dashed border-red-900 bg-red-950 bg-opacity-20">+</div>
                            <h3 class="text-2xl font-black text-white uppercase italic">No Upcoming Visits</h3>
                            <p class="text-gray-400 mb-8 max-w-xs">Book your next magic treatment today!</p>
                            <button @click="showModal = true; step = 1" class="bg-red-600 text-white px-8 py-3 rounded font-black uppercase tracking-tighter hover:bg-red-700 transition shadow-lg transform hover:scale-105">Book Appointment</button>
                        </div>
                        @endif

                        <div class="bg-card-dark rounded border border-red-900 overflow-hidden shadow-2xl">
                            <div class="px-6 py-4 border-b border-red-900 flex justify-between items-center bg-black bg-opacity-40">
                                <h3 class="font-bold text-white uppercase text-sm tracking-widest flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Recent Activity
                                </h3>
                                <a href="#" @click.prevent="currentTab = 'myappointments'" class="text-red-500 text-xs uppercase hover:underline font-bold">View History</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    @if($recentAppointments->count() > 0)
                                    <tbody class="divide-y divide-red-900/20">
                                        @foreach($recentAppointments as $app)
                                        <tr class="hover:bg-red-900/5 transition-colors">
                                            <td class="px-6 py-4">
                                                <p class="text-white font-bold uppercase text-[10px] italic">{{ $app->service ? $app->service->name : ($app->service_type ?? 'N/A') }}</p>
                                                <p class="text-[9px] text-gray-500 font-bold uppercase">{{ \Carbon\Carbon::parse($app->appointment_time)->format('M d, Y - h:i A') }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="status-badge status-{{ strtolower($app->status) }}">
                                                    {{ $app->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right text-white font-black italic text-[10px]">
                                                {{ $app->service ? '₱' . number_format($app->service->price, 2) : '---' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                    <div class="p-16 text-center text-gray-500">
                                        <p class="uppercase text-xs tracking-widest">No activity yet.</p>
                                        <button @click="showModal = true; step = 1" class="mt-4 text-red-500 font-bold border border-red-900 px-4 py-1 rounded hover:bg-red-900 hover:text-white transition">Book Your First</button>
                                    </div>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-card-dark rounded border border-red-900 p-6 shadow-2xl">
                            <h3 class="font-bold text-white uppercase text-sm tracking-widest mb-6 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                Quick Actions
                            </h3>
                            <div class="space-y-4">
                                <button @click="showModal = true; step = 1" class="w-full bg-red-600 text-white py-3 rounded font-black uppercase tracking-tighter hover:bg-red-700 transition">Book New Appointment</button>
                                <div class="flex flex-col space-y-4 pt-4">
                                    <a href="#" @click.prevent="currentTab = 'myappointments'" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                        View All Appointments
                                    </a>
                                    <a href="#" @click.prevent="currentTab = 'services'" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758L5 19m0-14l4.121 4.121" /></svg>
                                        Browse Services
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        Update Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="currentTab === 'myappointments'" x-cloak>
                @include('client.myappointments')
            </div>

            <div x-show="currentTab === 'services'" x-cloak>
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-white uppercase italic">Our Services</h1>
                    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Choose from our professional offerings</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template x-for="(service, index) in services" :key="index">
                        <div class="bg-card-dark border border-red-900 p-4 rounded group hover:border-red-600 transition-all flex flex-col shadow-lg">
                            <div class="relative">
                                <img :src="service.img" class="w-full h-40 object-cover rounded mb-4 opacity-70 group-hover:opacity-100 transition border border-red-900" 
                                     :onerror="`this.src='${window.location.origin}/images/service.jpg'`">
                                <span class="absolute top-2 right-2 bg-black bg-opacity-80 text-white text-[9px] font-black px-2 py-1 rounded border border-red-900 uppercase tracking-widest flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span x-text="service.duration"></span>
                                </span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-black text-white text-sm uppercase mb-1 tracking-tight" x-text="service.name"></h4>
                                <p class="text-gray-500 text-[10px] uppercase mb-4 font-bold leading-tight" x-text="service.desc"></p>
                            </div>
                            <div class="flex justify-between items-end pt-3 border-t border-red-900/50">
                                <div class="price-container cursor-help flex-1">
                                    <span class="text-[9px] text-gray-500 uppercase block font-bold">Starts At:</span>
                                    <span class="text-red-600 font-black text-lg leading-none" x-text="'₱' + service.price"></span>
                                    <div class="session-info mt-1" x-show="service.sessions">
                                        <template x-for="session in service.sessions">
                                            <p class="text-white text-[9px] font-bold uppercase tracking-tight" x-text="session"></p>
                                        </template>
                                    </div>
                                </div>
                                <button @click="showModal = true; step = 1; selectService(service.id, service.name, service.price, service.duration)" class="bg-red-600 text-white text-[10px] font-black px-4 py-2 uppercase tracking-widest hover:bg-white hover:text-black transition-colors shadow-lg">Book Now</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-90" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         style="display: none;">
        
        <div class="bg-card-dark w-full max-w-6xl rounded border border-red-900 shadow-2xl overflow-hidden flex flex-col max-h-[92vh]">
            <div class="bg-black border-b border-red-900 p-5 flex justify-between items-center shadow-xl">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/woman-with-long-hair.png') }}" class="w-8 h-8 white-icon">
                    <h2 class="text-white font-black uppercase italic tracking-tighter text-xl">
                        <span x-text="step === 1 ? 'Select Service' : 'Schedule Visit'"></span>
                    </h2>
                </div>
                <button @click="showModal = false; step = 1" class="text-gray-500 hover:text-red-600 text-3xl font-black transition leading-none">&times;</button>
            </div>

            <div class="p-8 overflow-y-auto custom-scroll bg-dark-home">
                <div x-show="step === 1" x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <template x-for="(service, index) in services" :key="index">
                            <div class="contents">
                                <template x-if="index === 0 || service.category !== services[index-1].category">
                                    <div class="col-span-full mt-12 mb-8 text-center">
                                        <h2 class="text-red-600 font-black uppercase text-4xl italic tracking-tighter inline-block border-b-4 border-red-600 pb-2" x-text="service.category"></h2>
                                    </div>
                                </template>

                                <div class="bg-card-dark border border-red-900 p-4 rounded group hover:border-red-600 transition-all flex flex-col shadow-lg">
                                    <div class="relative">
                                        <img :src="service.img" class="w-full h-40 object-cover rounded mb-4 opacity-70 group-hover:opacity-100 transition border border-red-900"
                                             :onerror="`this.src='${window.location.origin}/images/service.jpg'`">
                                        <span class="absolute top-2 right-2 bg-black bg-opacity-80 text-white text-[9px] font-black px-2 py-1 rounded border border-red-900 uppercase tracking-widest flex items-center">
                                            <svg class="w-3 h-3 mr-1 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <span x-text="service.duration"></span>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-black text-white text-sm uppercase mb-1 tracking-tight" x-text="service.name"></h4>
                                        <p class="text-gray-500 text-[10px] uppercase mb-4 font-bold leading-tight" x-text="service.desc"></p>
                                    </div>
                                    <div class="flex justify-between items-end pt-3 border-t border-red-900/50">
                                        <div class="price-container cursor-help flex-1">
                                            <span class="text-[9px] text-gray-500 uppercase block font-bold">Starts At:</span>
                                            <span class="text-red-600 font-black text-lg leading-none" x-text="'₱' + service.price"></span>
                                            <div class="session-info mt-1" x-show="service.sessions">
                                                <template x-for="session in service.sessions">
                                                    <p class="text-white text-[9px] font-bold uppercase tracking-tight" x-text="session"></p>
                                                </template>
                                            </div>
                                        </div>
                                        <button @click="selectService(service.id, service.name, service.price, service.duration)" class="bg-red-600 text-white text-[10px] font-black px-4 py-2 uppercase tracking-widest hover:bg-white hover:text-black transition-colors shadow-lg">Book Now</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="step === 2" x-transition class="max-w-md mx-auto py-4">
                    <button @click="step = 1" class="text-red-600 font-black text-[10px] uppercase mb-6 flex items-center hover:text-white transition group">
                        <span class="mr-2 group-hover:-translate-x-1 transition-transform">←</span> Back to Services
                    </button>
                    
                    <div class="bg-card-dark border border-red-900 p-8 rounded shadow-2xl space-y-6">
                        <div class="border-b border-red-900 pb-4">
                   
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1">Service Selected</p>
                            <h3 class="text-xl font-black text-white uppercase italic tracking-tighter" x-text="selectedService"></h3>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-red-600 font-black text-lg" x-text="'₱' + selectedPrice"></p>
                                <p class="text-gray-400 font-bold text-xs uppercase tracking-widest" x-text="'Duration: ' + selectedDuration"></p>
                            </div>
                        </div>

                        <form class="space-y-5" method="POST" action="{{ route('appointment.store') }}">
                            @csrf
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Select Date</label>
                                <input type="date" name="appointment_date" x-model="bookingData.date" required
                                    class="w-full bg-black border border-red-900 rounded p-3 text-white text-sm focus:border-red-600 focus:ring-0 outline-none">
                                @error('appointment_date')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Select Time</label>
                                <select name="appointment_time" x-model="bookingData.time" required
                                    class="w-full bg-black border border-red-900 rounded p-3 text-white text-sm focus:border-red-600 focus:ring-0 outline-none">
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
                                @error('appointment_time')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Services</label>
                                <input type="text" :value="selectedService" readonly
                                    class="w-full bg-black border border-red-900 rounded p-3 text-white text-sm focus:outline-none cursor-not-allowed border-opacity-50">
                                <input type="hidden" name="service_id" x-model="bookingData.service_id">
                                
                                @error('service_id')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                @error('price')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Phone Number</label>
                                <input type="number" name="phone" x-model="bookingData.phone" placeholder="0912 345 6789" required
                                    class="w-full bg-black border border-red-900 rounded p-3 text-white text-sm focus:border-red-600 focus:ring-0 outline-none">
                                @error('phone')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Special Requests</label>
                                <textarea name="message" x-model="bookingData.message" rows="2" 
                                    class="w-full bg-black border border-red-900 rounded p-3 text-white text-sm focus:border-red-600 focus:ring-0 outline-none"
                                    placeholder="Any specific requests?"></textarea>
                                @error('message')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="w-full bg-red-600 text-white py-4 rounded font-black uppercase tracking-widest shadow-lg hover:bg-white hover:text-black transition-all transform hover:scale-[1.02]">
                                Confirm Appointment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment Details Modal -->
    <div x-show="showDetailsModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-90" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-cloak
         style="display: none;">
        
        <div class="bg-card-dark w-full max-w-lg rounded border border-red-900 shadow-2xl overflow-hidden flex flex-col relative" @click.outside="showDetailsModal = false">
            <!-- Top Accent -->
            <div class="h-1 w-full bg-gradient-to-r from-red-600 via-red-900 to-red-600"></div>

            <div class="bg-black border-b border-red-900 p-6 flex justify-between items-center shadow-xl">
                <div>
                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-[0.25em] mb-1">Appointment Details</p>
                    <h2 class="text-white font-black uppercase italic tracking-tighter text-2xl" x-text="selectedAppointment ? (selectedAppointment.service ? selectedAppointment.service.name : 'Service') : '' "></h2>
                </div>
                <button @click="showDetailsModal = false" class="text-gray-500 hover:text-red-500 text-3xl font-black transition leading-none">&times;</button>
            </div>

            <div class="p-8 space-y-8 bg-dark-home">
                <template x-if="selectedAppointment">
                    <div class="space-y-6">
                        <!-- Status & Price Header -->
                        <div class="flex items-center justify-between border-b border-red-900/30 pb-6">
                            <span :class="'status-badge status-' + selectedAppointment.status.toLowerCase()" class="py-1.5 px-4 text-xs" x-text="selectedAppointment.status"></span>
                            <p class="text-3xl font-black text-white italic tracking-tighter" x-text="selectedAppointment.service ? '₱' + parseFloat(selectedAppointment.service.price.replace(/[^0-9.]/g, '')).toLocaleString() : '---'"></p>
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Date</p>
                                <div class="flex items-center text-white">
                                    <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    <span class="font-bold text-sm" x-text="new Date(selectedAppointment.appointment_time).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })"></span>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Time</p>
                                <div class="flex items-center text-white">
                                    <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span class="font-bold text-sm" x-text="new Date(selectedAppointment.appointment_time).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true })"></span>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Reference ID</p>
                                <p class="text-white font-bold" x-text="'#SALON-' + selectedAppointment.id"></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Client Name</p>
                                <p class="text-white font-bold">{{ Auth::user()->name }}</p>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="p-4 bg-black/40 rounded border border-red-900/30">
                            <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Notes & Requests</p>
                            <p class="text-gray-300 text-xs italic leading-relaxed" x-text="selectedAppointment.message || 'No special requests provided for this visit.'"></p>
                        </div>
                    </div>
                </template>
            </div>

            <div class="p-6 bg-black border-t border-red-900 flex justify-end">
                <button @click="showDetailsModal = false" class="bg-red-600 text-white px-8 py-3 rounded font-black uppercase tracking-tighter hover:bg-white hover:text-black transition shadow-lg">Close Details</button>
            </div>
        </div>
    </div>
</body>
</html>