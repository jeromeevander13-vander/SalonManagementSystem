<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tonet Salon | Team</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .team-header {
            background-color: #000;
            padding-bottom: 40px;
        }

        /* Responsive Title */
        .team-hero-title {
            font-size: clamp(2.5rem, 10vw, 4.5rem);
            line-height: 0.85;
            font-weight: 900;
            text-transform: uppercase;
        }

        .team-hero-title span {
            color: #ff0000;
        }

        .team-container {
            background-color: #666666;
            padding: 60px 0;
        }

        @media (min-width: 768px) {
            .team-container { padding: 80px 0; }
        }

        .stylist-card {
            text-align: center;
            color: #000;
            margin-bottom: 40px; /* Space between cards on mobile */
        }

        .stylist-image {
            width: 220px; /* Responsive size for mobile */
            height: 220px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 25px;
            border: 4px solid transparent;
            transition: border-color 0.3s ease;
        }

        @media (min-width: 768px) {
            .stylist-image {
                width: 280px;
                height: 280px;
            }
            .stylist-card { margin-bottom: 0; }
        }

        .stylist-card:hover .stylist-image {
            border-color: #ff0000;
        }

        .stylist-name {
            font-size: 24px;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .stylist-role {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .stylist-desc {
            font-size: 11px;
            font-weight: 700;
            line-height: 1.4;
            max-width: 250px;
            margin: 0 auto 20px;
        }

        .btn-know-more {
            background-color: #ff0000;
            color: white;
            padding: 6px 15px;
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
            display: inline-block;
            transition: background 0.3s;
        }

        .btn-know-more:hover {
            background-color: #000;
        }

        .force-black-footer {
            background-color: #000 !important;
            color: #fff !important;
        }

        .white-icon {
            filter: brightness(0) invert(1);
        }

        /* Mobile Menu Logic */
        #mobile-menu {
            display: none;
        }
        #mobile-menu.active {
            display: flex;
        }
    </style>
</head>
<body class="bg-black font-sans antialiased">

<header class="team-header text-white">
    <nav class="max-w-7xl mx-auto w-full px-6 py-5 flex justify-between items-center relative z-30">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/woman-with-long-hair.png') }}" alt="Logo" class="w-10 h-10 object-contain white-icon">
            <span class="font-black text-xl tracking-tighter uppercase italic leading-none">TONET SALON</span>
        </div>
        
        <div class="hidden md:flex items-center space-x-6 text-[10px] font-bold uppercase tracking-widest text-gray-300">
            <a href="{{ route('home') }}" class="{{ Request::is('/') ? 'text-white' : 'hover:text-red-600 transition' }}">Home</a>
            <a href="{{ route('services') }}" class="{{ Request::is('services') ? 'text-white' : 'hover:text-red-600 transition' }}">Services</a>
            <a href="{{ route('team') }}" class="{{ Request::is('team') ? 'text-white' : 'hover:text-red-600 transition' }}">Team</a>
            <a href="{{ route('about') }}" class="{{ Request::is('about') ? 'text-white' : 'hover:text-red-600 transition' }}">About</a>
            <a href="{{ route('gallery') }}" class="{{ Request::is('gallery') ? 'text-white' : 'hover:text-red-600 transition' }}">Gallery</a>
            <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 hover:bg-white hover:text-black transition">Sign Up</a>
        </div>

        <button id="menu-btn" class="md:hidden text-white text-2xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <div id="mobile-menu" class="flex-col bg-black w-full px-6 pb-6 space-y-4 md:hidden text-[10px] font-bold uppercase tracking-widest">
        <a href="{{ route('home') }}" class="block text-gray-300">Home</a>
        <a href="{{ route('services') }}" class="block text-gray-300">Services</a>
        <a href="{{ route('team') }}" class="block text-white">Team</a>
        <a href="{{ route('about') }}" class="block text-gray-300">About</a>
        <a href="{{ route('gallery') }}" class="block text-gray-300">Gallery</a>
        <a href="{{ route('register') }}" class="block text-red-600">Sign Up</a>
    </div>

    <div class="text-center mt-12 mb-10 px-4">
        <h1 class="team-hero-title">
             THIS IS OUR<br>
            <span>TEAM</span>
        </h1>
        <p class="uppercase text-[8px] md:text-[9px] tracking-[0.4em] text-gray-400 font-bold mt-6">
            Experience the magic of transformation
        </p>
    </div>
</header>

<section class="team-container">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16">
        
        <div class="stylist-card">
            <img src="{{ asset('images/tonet.png') }}" alt="Anthony Batac" class="stylist-image">
            <h3 class="stylist-name">Anthony Batac</h3>
            <p class="stylist-role">Owner/Manager</p>
            <p class="stylist-desc">
                Specializes Business Operations & Styling<br>
                11 Years of experience since 2015
            </p>
            <a href="https://www.facebook.com/tonet.neri.batac" class="btn-know-more" target="_blank">Know Him More</a>
        </div>

        <div class="stylist-card">
            <img src="{{ asset('images/haha.png') }}" alt="Jeralyn Sausa Desphy" class="stylist-image">
            <h3 class="stylist-name">Jeralyn Sausa Desphy</h3>
            <p class="stylist-role">Senior Staff</p>
            <p class="stylist-desc">
                Specializes Technical Service & Customer Care<br>
                11 Years of experience since 2010
            </p>
            <a href="#" class="btn-know-more">Know Her More</a>
        </div>

    </div>
</section>

<footer class="force-black-footer py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
            <h2 class="text-2xl md:text-4xl font-black italic uppercase leading-tight">
                READY FOR SEEING<br>
                <span class="text-red-600">A NEW LOOK?</span>
            </h2>
            <div class="flex gap-6 mt-8 md:mt-0 text-xl">
                <a href="#" class="hover:text-red-600 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-red-600 transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-red-600 transition"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <hr class="border-gray-800 mb-8">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="bg-white p-1 rounded-sm flex items-center justify-center w-6 h-6">
                    <i class="fas fa-phone text-red-600 text-xs"></i>
                </div>
                <span class="text-[11px] font-bold text-gray-400">0928 936 2396</span>
            </div>
            <div class="flex gap-4 md:gap-8 text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-gray-400 text-center">
                <a href="#" class="hover:text-white">Privacy Policy</a>
                <a href="#" class="hover:text-white">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Simple toggle for mobile menu
    document.getElementById('menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('active');
    });
</script>

</body>
</html>