<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Tonet Salon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .white-icon { filter: brightness(0) invert(1); }
        .nav-active { border-bottom: 2px solid #ff0000; color: white !important; padding-bottom: 2px; }
        
        /* Main Content Styling */
        .about-content { background-color: #666666; padding: 80px 0; color: #000; }
        .section-title { font-size: 28px; font-weight: 950; text-transform: uppercase; margin-bottom: 15px; line-height: 1; }
        .btn-red { background-color: #ff0000; color: white; padding: 10px 25px; font-size: 11px; font-weight: 900; text-transform: uppercase; display: inline-block; transition: 0.3s; }
        .btn-red:hover { background-color: #000; }
        
        /* Information Box */
        .info-card { background: white; padding: 25px; box-shadow: 8px 8px 0px #000; margin-top: 40px; }
        .info-line { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; font-weight: 800; font-size: 14px; }
        .blue-quote { border: 4px solid #3b82f6; padding: 15px; margin-top: 20px; font-weight: 900; font-style: italic; font-size: 15px; line-height: 1.4; }
    </style>
</head>
<body class="bg-black font-sans antialiased">
<header class="bg-black text-white pb-16">
    <nav class="max-w-7xl mx-auto w-full px-6 py-5 flex justify-between items-center relative z-30">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/woman-with-long-hair.png') }}" alt="Logo" class="w-8 h-8 object-contain white-icon">
            <span class="font-black text-xl tracking-tighter uppercase italic leading-none">TONET SALON</span>
        </div>
        
        <div class="hidden md:flex items-center space-x-8 text-[10px] font-bold uppercase tracking-widest text-gray-400">
            <a href="{{ route('home') }}" 
               class="{{ Request::is('/') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">
               Home
            </a>

            <a href="{{ route('services') }}" 
               class="{{ Request::is('services') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">
               Services
            </a>

            <a href="{{ route('team') }}" 
               class="{{ Request::is('team') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">
               Team
            </a>

            <a href="{{ route('about') }}" 
               class="{{ Request::is('about') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">
               About
            </a>

            <a href="{{ route('gallery') }}" 
               class="{{ Request::is('gallery') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">
               Gallery
            </a>

            <a href="{{ route('register') }}" class="bg-red-600 text-white px-5 py-2 hover:bg-white hover:text-black transition">
                Sign Up
            </a>
        </div>
    </nav>

    <div class="text-center mt-16">
        <h1 class="text-6xl md:text-8xl font-black uppercase italic leading-[0.8] tracking-tighter">
            ABOUT TONET<br>
            <span class="text-red-600 not-italic">SALON</span>
        </h1>
        <p class="uppercase tracking-[0.4em] text-[10px] text-gray-400 font-bold mt-8">
            Experience the magic of transformation
        </p>
    </div>
</header>

    <section class="about-content">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
            
            <div class="reveal">
                <img src="{{ asset('images/salons.jpg') }}" alt="Tonet Salon Front" class="w-full shadow-2xl mb-10 border-4 border-white">
                <h2 class="section-title">A Journey of Beauty & Resilience</h2>
                <p class="font-bold text-sm leading-relaxed mb-6">
                    Our story began on July 18, 2020. Founded by Anthony Batac, the salon opened its doors at a time when everyone was looking for a fresh start and a reason to feel confident again. What started as a vision to provide quality hair care in Danao City has grown into a beloved sanctuary for beauty and self-care.
                </p>
                <a href="{{ route('services') }}"  class="btn-red">View Services</a>
            </div>

            <div class="reveal">
                <div class="border-l-8 border-red-600 pl-6 mb-8">
                    <h2 class="section-title">5 Years of Trusted<br>Transformations</h2>
                </div>
                <p class="font-bold text-sm leading-relaxed mb-8">
                    For the past five years, Tonet's Salon has been more than just a place for a haircut. Located at the heart of Duterte St, Danao, Cebu, we have become a go-to destination for clients who value both skill and a welcoming atmosphere. Under the personal leadership of Anthony Batac, we have spent half a decade perfecting our craft.
                </p>
                
                <div class="info-card">
                    <div class="info-line"><i class="fas fa-phone text-blue-600 w-5"></i> Contact Number: 0928 936 2396</div>
                    <div class="info-line"><i class="fas fa-map-marker-alt text-red-600 w-5"></i> Location: Duterte St, Danao, Cebu (G2CG+7H7)</div>
                    <div class="info-line"><i class="fas fa-user text-blue-400 w-5"></i> Owner: Tonet Neri Batac</div>
                    <div class="info-line"><i class="fas fa-calendar-check text-red-400 w-5"></i> Serving you since: July 18, 2020</div>
                    
                    <div class="blue-quote">
                        "At Tonet's Salon, we don't just style hair—we boost your confidence. Come in and experience the transformation you deserve."
                    </div>
                </div>
            </div>

        </div>
    </section>

    <footer class="bg-black py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16">
                <h2 class="text-5xl font-black italic text-white uppercase leading-[0.9]">READY FOR SEEING<br><span class="text-red-600">A NEW LOOK?</span></h2>
                <div class="flex space-x-6 mt-10 md:mt-0 text-2xl text-white">
                    <a href="#" class="hover:text-red-600 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-red-600 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-red-600 transition"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <hr class="border-gray-800 mb-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-4">
                    <div class="bg-white p-2 rounded-sm w-8 h-8 flex items-center justify-center">
                        <i class="fas fa-phone text-red-600 text-sm"></i>
                    </div>
                    <span class="text-xs font-black text-gray-400 tracking-widest">0928 936 2396</span>
                </div>
                <div class="flex gap-10 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>