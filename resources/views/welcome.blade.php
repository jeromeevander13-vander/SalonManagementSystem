<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tonet Salon | Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background-color: #000;
            background-image: linear-gradient(to bottom, #1a1a1a 0%, #000 100%);
            min-height: 80vh; 
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .hero-section::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 100%; /* Default for mobile */
            height: 100%;
            background-image: url("{{ asset('images/atonet.jpg') }}");
            background-size: cover;
            background-position: center right;
            background-repeat: no-repeat;
            /* Improved mask for mobile: fades top to bottom or left to right */
            mask-image: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, black 100%);
            -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, black 100%);
            z-index: 1;
            opacity: 0.6; /* Higher visibility on mobile */
        }

        @media (min-width: 768px) {
            .hero-section::after {
                width: 65%;
                mask-image: linear-gradient(to right, transparent 0%, black 35%);
                -webkit-mask-image: linear-gradient(to right, transparent 0%, black 35%);
                opacity: 1;
            }
        }

        .slant-bottom {
            clip-path: polygon(0 0, 100% 0, 100% 95%, 0% 100%);
        }

        .content-container {
            position: relative;
            z-index: 20;
            flex: 1;
            display: flex;
            align-items: center;
        }

        .hero-title {
            font-size: clamp(2.5rem, 12vw, 5.5rem); 
            line-height: 0.85; 
            letter-spacing: -0.04em; 
            font-weight: 950;
            transform: scaleY(1.2); 
            transform-origin: left;
            margin-bottom: 20px; 
        }

        @media (min-width: 768px) {
            .hero-title {
                line-height: 0.75;
                transform: scaleY(1.4);
            }
        }

        .shine-text {
            color: #ff0000;
            display: block;
        }

        .hero-subtitle {
            margin-top: 30px; 
            color: #d1d5db;
            text-transform: uppercase;
            letter-spacing: 0.2em; 
            font-size: 10px;
            font-weight: 700;
        }

        .white-icon {
            filter: brightness(0) invert(1);
        }

        .nav-active {
            border-bottom: 2px solid #ff0000;
            padding-bottom: 2px;
        }

        /* FOOTER SPECIFIC STYLES */
        footer {
            background-color: #000;
            color: #fff;
            padding: 40px 0 30px 0;
            font-family: sans-serif;
        }

        .footer-heading {
            font-size: clamp(1.8rem, 8vw, 2.5rem);
            font-weight: 900;
            line-height: 1.1;
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }

        .footer-heading span {
            color: #ff0000;
            display: block;
        }

        .footer-link {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: color 0.3s;
        }

        .footer-link:hover {
            color: #ff0000;
        }

        .social-icon {
            font-size: 1.2rem;
            transition: transform 0.3s;
        }
    </style>
</head>
<body class="antialiased bg-[#f3f4f6] font-sans">

  <header class="hero-section slant-bottom text-white">
    <nav class="max-w-7xl mx-auto w-full px-6 py-5 flex justify-between items-center relative z-30">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/woman-with-long-hair.png') }}" alt="Logo" class="w-8 h-8 object-contain white-icon">
            <span class="font-black text-lg md:text-xl tracking-tighter uppercase italic leading-none">TONET SALON</span>
        </div>
        
        <div class="hidden md:flex items-center space-x-8 text-[10px] font-bold uppercase tracking-widest text-gray-300">
            <a href="{{ route('home') }}" class="{{ Request::is('/') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">Home</a>
            <a href="{{ route('services') }}" class="{{ Request::is('services') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">Services</a>
            <a href="{{ route('team') }}" class="{{ Request::is('team') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">Team</a>
            <a href="{{ route('about') }}" class="{{ Request::is('about') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">About</a>
            <a href="{{ route('gallery') }}" class="{{ Request::is('gallery') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">Gallery</a>
            <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 hover:bg-white hover:text-black transition">Sign Up</a>
        </div>
        <div class="md:hidden">
            <a href="{{ route('register') }}" class="bg-red-600 text-[10px] font-bold text-white px-3 py-2 uppercase">Sign Up</a>
        </div>
    </nav>

    <div class="content-container max-w-7xl mx-auto w-full px-6 pb-16">
        <div class="max-w-xl">
            <h1 class="hero-title uppercase italic">UNVEIL YOUR<br><span class="shine-text not-italic">SHINE</span></h1>
            <p class="hero-subtitle">Experience the magic of transformation</p>
            <div class="mt-8">
                <a href="{{ route('login') }}" class="inline-block bg-red-600 text-white px-8 md:px-10 py-4 font-black uppercase tracking-widest text-[10px] hover:bg-white hover:text-black transition">
                    Book Appointment
                </a>
            </div>
        </div>
    </div>
</header>

    <section class="max-w-7xl mx-auto px-6 py-16 md:py-24 grid grid-cols-1 md:grid-cols-10 gap-8 md:gap-12 items-center text-black">
        <div class="md:col-span-4 flex justify-center order-2 md:order-1">
            <div class="w-full shadow-2xl">
                <img src="{{ asset('images/ahasd.png') }}" alt="Journey" class="w-full h-auto rounded-sm">
            </div>
        </div>
        <div class="md:col-span-6 border-l-4 border-red-600 pl-6 md:pl-10 order-1 md:order-2">
            <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tighter leading-[1] md:leading-[0.9]">YOUR JOURNEY<br>TO BEAUTY</h2>
            <p class="mt-6 md:mt-8 text-gray-600 text-base md:text-lg italic leading-relaxed">Step into Tonet Salon, where our stylists and premium teams transform your look into something that brings beauty to life.</p>
            <a href="/services" class="mt-8 md:mt-10 inline-block bg-red-600 text-white px-8 py-3 font-bold uppercase tracking-widest text-[11px] hover:bg-black transition">VIEW SERVICES</a>
        </div>
    </section>

    <footer>
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 md:mb-16">
                <div>
                    <h2 class="footer-heading italic">
                        Ready for seeing<br>
                        <span>A new look?</span>
                    </h2>
                </div>
                <div class="flex space-x-6 mt-8 md:mt-0">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <hr class="border-gray-800 mb-8">

            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1 rounded-sm">
                        <i class="fas fa-phone text-red-600 text-xs"></i>
                    </div>
                    <a href="tel:09289362396" class="text-[11px] font-bold text-gray-400 hover:text-white transition">
                        09289362396
                    </a>
                </div>
                <div class="flex space-x-6 md:space-x-8">
                    <a href="#" class="footer-link text-gray-400">Privacy Policy</a>
                    <a href="#" class="footer-link text-gray-400">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>