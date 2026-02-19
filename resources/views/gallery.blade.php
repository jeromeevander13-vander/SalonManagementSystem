<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery | Tonet Salon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .white-icon { filter: brightness(0) invert(1); }
        .nav-active { border-bottom: 2px solid #ff0000; color: white !important; }
        
        .content-mid { 
            max-width: 1000px; 
            margin-left: auto; 
            margin-right: auto; 
            padding-left: 20px;
            padding-right: 20px;
        }

        .gallery-bg { background-color: #616161; min-height: 80vh; }
        
        /* Responsive Section Title */
        .section-title { font-size: clamp(24px, 6vw, 32px); font-weight: 900; line-height: 1; text-transform: uppercase; text-align: center; color: white; }
        .section-title span { color: #ff0000; }
        
        /* Image Cards */
        .img-card { transition: transform 0.3s ease; display: flex; gap: 4px; }
        .img-card:hover { transform: scale(1.02); }
        .img-card img { 
            box-shadow: 0 4px 15px rgba(0,0,0,0.5); 
            width: 50%; /* Each image takes half for Before/After */
            height: 220px; 
            object-fit: cover; 
        }

        @media (min-width: 768px) {
            .img-card img { height: 280px; }
        }

        /* Mobile Menu */
        #mobile-menu { display: none; }
        #mobile-menu.active { display: flex; }
    </style>
</head>
<body class="bg-black font-sans antialiased">

    <header class="bg-black text-white pb-8 md:pb-12">
        <div class="content-mid">
            <nav class="py-5 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/woman-with-long-hair.png') }}" class="w-8 h-8 white-icon">
                    <span class="font-black text-xl italic uppercase">TONET SALON</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <a href="{{ route('home') }}" class="hover:text-red-600 transition">Home</a>
                    <a href="{{ route('services') }}" class="hover:text-red-600 transition">Services</a>
                    <a href="{{ route('team') }}" class="hover:text-red-600 transition">Team</a>
                    <a href="{{ route('about') }}" class="hover:text-red-600 transition">About</a>
                    <a href="{{ route('gallery') }}" class="nav-active">Gallery</a>
                    <a href="{{ route('register') }}" class="bg-red-600 text-white px-5 py-2 hover:bg-white hover:text-black transition">Sign Up</a>
                </div>

                <button id="menu-btn" class="md:hidden text-white text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>

            <div id="mobile-menu" class="hidden flex-col bg-black w-full py-4 space-y-4 md:hidden text-[11px] font-bold uppercase tracking-widest border-b border-gray-900">
                <a href="{{ route('home') }}" class="text-gray-400">Home</a>
                <a href="{{ route('services') }}" class="text-gray-400">Services</a>
                <a href="{{ route('team') }}" class="text-gray-400">Team</a>
                <a href="{{ route('about') }}" class="text-gray-400">About</a>
                <a href="{{ route('gallery') }}" class="text-white">Gallery</a>
                <a href="{{ route('register') }}" class="text-red-600">Sign Up</a>
            </div>

            <div class="text-center mt-12 md:mt-16 px-4">
                <h1 class="text-5xl md:text-7xl font-black italic uppercase leading-none">Our <span class="text-red-600 not-italic">Gallery</span></h1>
                <p class="uppercase tracking-[0.3em] md:tracking-[0.4em] text-[8px] md:text-[10px] text-gray-400 font-bold mt-6">Experience the magic of transformation</p>
            </div>
        </div>
    </header>

    <section class="gallery-bg py-12 md:py-20">
        <div class="content-mid">
            
            <h2 class="section-title mb-10 md:mb-16">BEFORE AND<br><span>AFTER TRANSFORMATION</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10 md:gap-y-16">
                <div class="img-card">
                    <img src="{{ asset('images/a.jpg') }}" alt="Before">
                    <img src="{{ asset('images/a1.jpg') }}" alt="After">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/B.jpg') }}" alt="Before">
                    <img src="{{ asset('images/B2.jpg') }}" alt="After">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/C.jpg') }}" alt="Before">
                    <img src="{{ asset('images/C2.jpg') }}" alt="After">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/D.jpg') }}" alt="Before">
                    <img src="{{ asset('images/D1.jpg') }}" alt="After">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/E.jpg') }}" alt="Before">
                    <img src="{{ asset('images/E1.jpg') }}" alt="After">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/F.jpg') }}" alt="Before">
                    <img src="{{ asset('images/F2.jpg') }}" alt="After">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/G.jpg') }}" alt="Before">
                    <img src="{{ asset('images/G2.jpg') }}" alt="After">
                </div>
            </div>

            <h2 class="section-title mt-20 md:mt-32 mb-10 md:mb-16">OUR FINISHED<br><span>SERVICES</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10 md:gap-y-16">
                <div class="img-card">
                    <img src="{{ asset('images/services1.jpg') }}">
                    <img src="{{ asset('images/services2.jpg') }}">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/services3.jpg') }}">
                    <img src="{{ asset('images/services4.jpg') }}">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/services5.jpg') }}">
                    <img src="{{ asset('images/services6.jpg') }}">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/services7.jpg') }}">
                    <img src="{{ asset('images/services8.jpg') }}">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/services9.jpg') }}">
                    <img src="{{ asset('images/services10.jpg') }}">
                </div>
                <div class="img-card">
                    <img src="{{ asset('images/services11.jpg') }}">
                    <img src="{{ asset('images/services12.jpg') }}">
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black py-16 text-white border-t border-gray-900">
        <div class="content-mid">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black italic uppercase leading-none">Ready for seeing<br><span class="text-red-600">A new look?</span></h2>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="bg-white p-2 rounded-sm"><i class="fas fa-phone text-red-600 text-xs"></i></div>
                        <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase">0928 936 2396</span>
                    </div>
                </div>
                <div class="mt-12 md:mt-0 flex flex-col items-start md:items-end w-full md:w-auto">
                    <div class="flex gap-6 text-xl mb-8 md:mb-12">
                        <i class="fab fa-facebook-f hover:text-red-600 cursor-pointer"></i>
                        <i class="fab fa-instagram hover:text-red-600 cursor-pointer"></i>
                        <i class="fab fa-tiktok hover:text-red-600 cursor-pointer"></i>
                    </div>
                    <div class="flex flex-wrap gap-6 md:gap-8 text-[9px] font-bold uppercase tracking-widest text-gray-500">
                        <a href="#" class="hover:text-white transition">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            const icon = menuBtn.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });
    </script>
</body>
</html>