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
        
        /* This centers the content in the middle of the screen */
        .content-mid { 
            max-width: 1000px; 
            margin-left: auto; 
            margin-right: auto; 
            padding-left: 20px;
            padding-right: 20px;
        }

        .gallery-bg { background-color: #616161; min-height: 80vh; }
        
        .section-title { font-size: 32px; font-weight: 900; line-height: 0.9; text-transform: uppercase; text-align: center; color: white; }
        .section-title span { color: #ff0000; }
        
        .img-card { transition: transform 0.3s ease; }
        .img-card:hover { transform: scale(1.02); }
        .img-card img { box-shadow: 0 4px 15px rgba(0,0,0,0.5); width: 100%; height: 280px; object-fit: cover; }
    </style>
</head>
<body class="bg-black font-sans antialiased">

    <header class="bg-black text-white pb-12">
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
            </nav>

            <div class="text-center mt-16">
                <h1 class="text-7xl font-black italic uppercase leading-none">Our <span class="text-red-600 not-italic">Gallery</span></h1>
                <p class="uppercase tracking-[0.4em] text-[10px] text-gray-400 font-bold mt-6">Experience the magic of transformation</p>
            </div>
        </div>
    </header>

    <section class="gallery-bg py-20">
        <div class="content-mid">
            
            <h2 class="section-title mb-16">BEFORE AND<br><span>AFTER TRANSFORMATION</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-16">
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/a.jpg') }}" alt="Before">
                    <img src="{{ asset('images/a1.jpg') }}" alt="After">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/B.jpg') }}" alt="Before">
                    <img src="{{ asset('images/B2.jpg') }}" alt="After">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/C.jpg') }}" alt="Before">
                    <img src="{{ asset('images/C2.jpg') }}" alt="After">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/D.jpg') }}" alt="Before">
                    <img src="{{ asset('images/D1.jpg') }}" alt="After">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/E.jpg') }}" alt="Before">
                    <img src="{{ asset('images/E1.jpg') }}" alt="After">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/F.jpg') }}" alt="Before">
                    <img src="{{ asset('images/F2.jpg') }}" alt="After">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/G.jpg') }}" alt="Before">
                    <img src="{{ asset('images/G2.jpg') }}" alt="After">
                </div>

            </div>

            <h2 class="section-title mt-32 mb-16">OUR FINISHED<br><span>SERVICES</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-16">
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/services1.jpg') }}">
                    <img src="{{ asset('images/services2.jpg') }}">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/services3.jpg') }}">
                    <img src="{{ asset('images/services4.jpg') }}">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/services5.jpg') }}">
                    <img src="{{ asset('images/services6.jpg') }}">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/services7.jpg') }}">
                    <img src="{{ asset('images/services8.jpg') }}">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/services9.jpg') }}">
                    <img src="{{ asset('images/services10.jpg') }}">
                </div>
                <div class="flex gap-1 img-card">
                    <img src="{{ asset('images/services11.jpg') }}">
                    <img src="{{ asset('images/services12.jpg') }}">
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black py-20 text-white border-t border-gray-900">
        <div class="content-mid">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h2 class="text-4xl font-black italic uppercase leading-none">Ready for seeing<br><span class="text-red-600">A new look?</span></h2>
                    <div class="mt-8 flex items-center gap-3">
                        <div class="bg-white p-2 rounded-sm"><i class="fas fa-phone text-red-600"></i></div>
                        <span class="text-xs font-bold tracking-widest text-gray-400">0928 936 2396</span>
                    </div>
                </div>
                <div class="mt-10 md:mt-0 flex flex-col items-end">
                    <div class="flex gap-6 text-xl mb-12">
                        <i class="fab fa-facebook-f hover:text-red-600 cursor-pointer"></i>
                        <i class="fab fa-instagram hover:text-red-600 cursor-pointer"></i>
                        <i class="fab fa-tiktok hover:text-red-600 cursor-pointer"></i>
                    </div>
                    <div class="flex gap-8 text-[10px] font-bold uppercase tracking-widest text-gray-500">
                        <a href="#" class="hover:text-white transition">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>