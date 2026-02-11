<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Beauty Parlor Management System</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Matching the dark home page background */
        .bg-dark-home { background-color: #121212; }
        .bg-card-dark { background-color: #1e1e1e; }
        .border-dark-red { border-color: #3d0a0a; }
    </style>
</head>
<body class="font-sans antialiased bg-dark-home text-gray-200" x-data="{ 
    appointments: [],
    showModal: false 
}">
    <div class="min-h-screen">
        <nav class="bg-black border-b border-red-900 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-14">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-red-600 text-2xl font-bold">✂</span>
                            <span class="text-lg font-bold tracking-tight uppercase">Tonet Salon Management System</span>
                        </div>
                        
                        <div class="hidden md:flex space-x-2 ml-10 text-xs font-bold uppercase tracking-widest">
                            <a href="{{ route('client_main') }}" class="text-red-500 bg-red-950 bg-opacity-30 px-3 py-2 rounded flex items-center border border-red-900">
                                Dashboard
                            </a>
                            <a href="#" @click="showModal = true" class="hover:text-red-500 px-3 py-2 transition flex items-center">
                                Book Appointment
                            </a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition flex items-center">
                                My Appointments
                            </a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition flex items-center">
                                Invoices
                            </a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition flex items-center">
                                Services
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center text-xs font-bold uppercase hover:text-red-500 transition">
                                👤 {{ Auth::user()->name }}
                                <svg class="ms-1 fill-current h-4 w-4 text-red-600" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg>
                            </button>

                            <div x-show="dropdownOpen" class="absolute right-0 z-50 mt-2 w-48 rounded shadow-xl bg-card-dark border border-red-900 py-1 text-gray-300" style="display: none;">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-red-900 hover:text-white">Profile Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-900 hover:text-white font-bold" onclick="event.preventDefault(); this.closest('form').submit();">
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
                <h1 class="text-3xl font-black text-white uppercase italic">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-red-500 font-medium tracking-wide">Manage your appointments and beauty treatments.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-card-dark p-6 rounded border border-red-900 flex justify-between items-center shadow-2xl">
                    <div>
                        <p class="text-5xl font-black text-white" x-text="appointments.length">0</p>
                        <p class="text-gray-400 text-xs font-bold uppercase mt-1">Total Appointments</p>
                    </div>
                    <div class="text-red-600 text-3xl">📅</div>
                </div>
                <div class="bg-card-dark p-6 rounded border border-red-900 flex justify-between items-center shadow-2xl">
                    <div>
                        <p class="text-5xl font-black text-white">0</p>
                        <p class="text-gray-400 text-xs font-bold uppercase mt-1">Upcoming Appointments</p>
                    </div>
                    <div class="text-yellow-500 text-3xl">🕒</div>
                </div>
                <div class="bg-card-dark p-6 rounded border border-red-900 flex justify-between items-center shadow-2xl">
                    <div>
                        <p class="text-5xl font-black text-white">$0.00</p>
                        <p class="text-gray-400 text-xs font-bold uppercase mt-1">Total Spent</p>
                    </div>
                    <div class="text-blue-500 text-3xl">💰</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-card-dark p-12 rounded border border-red-900 flex flex-col items-center justify-center text-center shadow-2xl">
                        <div class="w-20 h-20 rounded-full mb-6 flex items-center justify-center text-red-600 text-4xl font-bold border-2 border-dashed border-red-900 bg-red-950 bg-opacity-20">
                            +
                        </div>
                        <h3 class="text-2xl font-black text-white uppercase italic">No Upcoming Appointments</h3>
                        <p class="text-gray-400 mb-8 max-w-xs">Book your next magic treatment today!</p>
                        <button @click="showModal = true" class="bg-red-600 text-white px-8 py-3 rounded font-black uppercase tracking-tighter hover:bg-red-700 transition shadow-lg transform hover:scale-105">
                            Book Appointment
                        </button>
                    </div>

                    <div class="bg-card-dark rounded border border-red-900 overflow-hidden shadow-2xl">
                        <div class="px-6 py-4 border-b border-red-900 flex justify-between items-center bg-black bg-opacity-40">
                            <h3 class="font-bold text-white uppercase text-sm tracking-widest flex items-center">
                                <span class="mr-2 text-red-600">🕒</span> Recent Appointments
                            </h3>
                            <a href="#" class="text-red-500 text-xs uppercase hover:underline font-bold">View All</a>
                        </div>
                        <div class="p-16 text-center text-gray-500">
                            <p class="uppercase text-xs tracking-widest">No appointments found.</p>
                            <button @click="showModal = true" class="mt-4 text-red-500 font-bold border border-red-900 px-4 py-1 rounded hover:bg-red-900 hover:text-white transition">Book Your First</button>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-card-dark rounded border border-red-900 p-6 shadow-2xl">
                        <h3 class="font-bold text-white uppercase text-sm tracking-widest mb-6 flex items-center">
                            <span class="mr-2 text-red-600">⚡</span> Quick Actions
                        </h3>
                        <div class="space-y-4">
                            <button @click="showModal = true" class="w-full bg-red-600 text-white py-3 rounded font-black uppercase tracking-tighter hover:bg-red-700 transition">
                                Book New Appointment
                            </button>
                            <div class="flex flex-col space-y-4 pt-4">
                                <a href="#" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center">
                                   <span class="mr-2 text-red-600">📋</span> View All Appointments
                                </a>
                                <a href="#" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center">
                                   <span class="mr-2 text-red-600">📄</span> View Invoices
                                </a>
                                <a href="#" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center">
                                   <span class="mr-2 text-red-600">🌿</span> Browse Services
                                </a>
                                <a href="{{ route('profile.edit') }}" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center">
                                   <span class="mr-2 text-red-600">👤</span> Update Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-card-dark rounded border border-red-900 p-6 text-center shadow-2xl">
                        <h3 class="font-bold text-white uppercase text-sm tracking-widest mb-4">❤️ Favorite Services</h3>
                        <p class="text-xs text-gray-500 uppercase tracking-widest">Book more treatments!</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black bg-opacity-80" @click="showModal = false"></div>
            <div class="bg-card-dark border border-red-900 rounded shadow-2xl p-8 z-50 w-full max-w-md">
                <h3 class="text-2xl font-black text-white uppercase italic mb-6">Book a Treatment</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-red-500 uppercase mb-1">Select Service</label>
                        <select class="w-full bg-black border-red-900 text-white rounded focus:ring-red-600">
                            <option>Hair Cut & Styling</option>
                            <option>Premium Hair Color</option>
                            <option>Luxury Manicure</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-red-500 uppercase mb-1">Pick Date & Time</label>
                        <input type="datetime-local" class="w-full bg-black border-red-900 text-white rounded focus:ring-red-600">
                    </div>
                    <div class="pt-4 flex flex-col space-y-2">
                        <button @click="showModal = false" class="w-full bg-red-600 text-white py-3 rounded font-bold uppercase hover:bg-red-700 transition shadow-lg">
                            Confirm Request
                        </button>
                        <button @click="showModal = false" class="w-full py-2 text-gray-500 text-xs font-bold uppercase hover:text-white transition">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>