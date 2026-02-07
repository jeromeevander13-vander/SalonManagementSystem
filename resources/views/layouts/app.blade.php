<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tonet Salon')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .white-icon { filter: brightness(0) invert(1); }
        .nav-active { border-bottom: 2px solid #ff0000; color: white !important; }
        footer { background-color: #000 !important; color: #fff !important; }
        .footer-heading { font-size: 42px; font-weight: 900; line-height: 0.9; text-transform: uppercase; font-style: italic; }
        .footer-heading span { color: #ff0000; }
    </style>
    @yield('styles')
</head>
<body class="bg-[#efefef] font-sans antialiased">

    <header class="bg-black text-white">
        <nav class="max-w-7xl mx-auto w-full px-6 py-5 flex justify-between items-center relative z-30">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/woman-with-long-hair.png') }}" alt="Logo" class="w-8 h-8 object-contain white-icon">
                <span class="font-black text-xl tracking-tighter uppercase italic leading-none">TONET SALON</span>
            </div>
            
            <div class="hidden md:flex items-center space-x-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                <a href="{{ route('home') }}" class="{{ Request::is('/') ? 'nav-active' : 'hover:text-red-600 transition' }}">Home</a>
                <a href="{{ route('services') }}" class="{{ Request::is('services') ? 'nav-active' : 'hover:text-red-600 transition' }}">Services</a>
                <a href="{{ route('team') }}" class="{{ Request::is('team') ? 'nav-active' : 'hover:text-red-600 transition' }}">Team</a>
                <a href="{{ route('about') }}" class="{{ Request::is('about') ? 'nav-active' : 'hover:text-red-600 transition' }}">About</a>
                <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 hover:bg-white hover:text-black transition">Sign Up</a>
            </div>
        </nav>
        @yield('header_content')
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="py-16 mt-auto">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
                <h2 class="footer-heading">Ready for seeing<br><span>A new look?</span></h2>
                <div class="flex space-x-6 mt-8 md:mt-0 text-xl">
                    <a href="#" class="hover:text-red-600 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-red-600 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-red-600 transition"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <hr class="border-gray-800 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1 rounded-sm w-6 h-6 flex items-center justify-center">
                        <i class="fas fa-phone text-red-600 text-xs"></i>
                    </div>
                    <a href="tel:09289362396" class="text-[11px] font-bold text-gray-400">09289362396</a>
                </div>
                <div class="flex space-x-8 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <a href="#" class="hover:text-white">Privacy Policy</a>
                    <a href="#" class="hover:text-white">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>