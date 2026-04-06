<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tonet Salon - Profile Settings</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
        .white-icon { filter: brightness(0) invert(1); }
        .bg-dark-home { background-color: #121212; }
        .bg-card-dark { background-color: #1e1e1e; }
        
        .profile-card {
            background: #0a0a0a;
            border: 1px solid #1a1a1a;
            transition: all 0.3s ease;
        }
        .profile-card:hover { border-color: #dc2626; }
        input, select, textarea {
            background-color: #000 !important;
            border-color: #1a1a1a !important;
            color: #fff !important;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #dc2626 !important;
            --tw-ring-color: #dc2626 !important;
        }
        label {
            color: #9ca3af !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
        }
        .bg-gray-800 {
            background-color: #dc2626 !important;
            text-transform: uppercase;
            font-weight: 900;
            font-style: italic;
            padding: 0.75rem 1.5rem !important;
        }
        .bg-gray-800:hover { background-color: #fff !important; color: #000 !important; }
        .text-gray-900 { color: #fff !important; font-weight: 900; text-transform: uppercase; font-style: italic; }
        .text-gray-600 { color: #9ca3af !important; }
    </style>
</head>
<body class="bg-black text-gray-200 font-sans antialiased" x-data="{ mobileMenuOpen: false }">
    <div class="min-h-screen">
        <!-- Dashboard Style Navigation -->
        <nav class="bg-black border-b border-red-900 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-14">
                    <div class="flex items-center space-x-4">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-400 hover:text-red-500 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('images/woman-with-long-hair.png') }}" class="w-8 h-8 white-icon">
                            <span class="text-lg font-black tracking-tighter uppercase italic">Tonet Salon</span>
                        </div>
                        <div class="hidden md:flex space-x-2 ml-10 text-xs font-bold uppercase tracking-widest">
                            <a href="{{ route('client_main') }}" class="px-3 py-2 rounded flex items-center transition hover:text-red-500">Dashboard</a>
                            <a href="{{ route('client_main') }}?tab=myappointments" class="px-3 py-2 rounded transition flex items-center hover:text-red-500">My Appointments</a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none group">
                                <span class="hidden sm:inline text-[10px] font-black uppercase mr-2 text-gray-500 italic group-hover:text-red-500 transition tracking-widest">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                                <div class="w-8 h-8 rounded-full bg-red-600 overflow-hidden flex items-center justify-center font-black text-xs text-white border border-red-400 shadow-lg transition group-hover:scale-110">
                                    @if(\Illuminate\Support\Facades\Auth::user()->avatar)
                                        <img src="{{ strpos(\Illuminate\Support\Facades\Auth::user()->avatar, 'avatars/') === 0 ? \Illuminate\Support\Facades\Storage::disk('s3')->url(\Illuminate\Support\Facades\Auth::user()->avatar) : asset('storage/' . \Illuminate\Support\Facades\Auth::user()->avatar) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    @endif
                                </div>
                                <svg class="ms-1 fill-current h-4 w-4 text-red-600 transition-transform group-hover:translate-y-0.5" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg>
                            </button>
                            <div x-show="dropdownOpen" x-cloak class="absolute right-0 z-50 mt-2 w-48 rounded shadow-xl bg-card-dark border border-red-900 py-1 text-gray-300">
                                <a href="{{ route('client.profile') }}" class="block px-4 py-2 text-sm bg-red-900 text-white">Profile Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-900 hover:text-white font-bold" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="mobileMenuOpen" x-cloak class="md:hidden bg-black border-t border-red-900 px-4 py-2 space-y-1">
                <a href="{{ route('client_main') }}" class="block px-3 py-4 text-xs font-bold uppercase tracking-widest text-gray-300 hover:text-red-500">Dashboard</a>
            </div>
        </nav>

        <div class="py-12 bg-black">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-12 text-center">
                    <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter">
                        Account <span class="text-red-600">Settings</span>
                    </h1>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-2">Manage your personal information and security</p>
                </div>

                <div class="space-y-8">
                    <!-- Profile Information -->
                    <div class="profile-card p-8 rounded-none border-l-4 border-l-red-600 shadow-2xl">
                        <div class="max-w-xl">
                            <h2 class="text-xl font-black text-white uppercase italic mb-6">Profile Information</h2>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="profile-card p-8 rounded-none border-l-4 border-l-gray-800 shadow-2xl">
                        <div class="max-w-xl">
                            <h2 class="text-xl font-black text-white uppercase italic mb-6">Security & Password</h2>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div class="profile-card p-8 rounded-none border-l-4 border-l-red-900 bg-red-950/5 shadow-2xl opacity-80 hover:opacity-100 transition-opacity">
                        <div class="max-w-xl">
                            <h2 class="text-xl font-black text-red-600 uppercase italic mb-6">Danger Zone</h2>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

                <!-- Back to Dashboard -->
                <div class="mt-12 text-center">
                    <a href="{{ route('client_main') }}" class="text-gray-500 hover:text-red-500 font-bold uppercase tracking-widest text-xs transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>