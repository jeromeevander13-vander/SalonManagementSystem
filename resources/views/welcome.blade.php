@php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tonet Salon | Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* 1. GLOBAL REFINEMENTS */
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            background-color: #000; 
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* 2. NAVIGATION & MOBILE MENU */
        nav.fixed-top {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,0,0,0.2); 
        }

        .white-icon { filter: brightness(0) invert(1); }

        #mobile-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.98);
            z-index: 9998;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #mobile-menu.active { opacity: 1; visibility: visible; }
        .mobile-link { font-size: 2.5rem; font-weight: 900; text-transform: uppercase; color: white; margin: 15px 0; text-decoration: none; letter-spacing: -0.05em; }

        /* 3. HERO SECTION */
        .hero-section {
            background: #000 linear-gradient(180deg, #110000 0%, #000 100%); 
            min-height: 85vh; 
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 60%;
            height: 100%;
            background: url("{{ asset('images/atonet.jpg') }}") center right/cover no-repeat;
            mask-image: linear-gradient(to right, transparent 0%, black 40%);
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 40%);
            z-index: 1;
        }

        .hero-title {
            font-size: clamp(3rem, 10vw, 6.5rem); 
            line-height: 0.85; 
            letter-spacing: -0.05em; 
            font-weight: 900;
            text-transform: uppercase;
            color: white;
            position: relative;
            z-index: 2;
        }

        .shine-text { color: #ff0000; display: block; font-style: normal; }

        /* 4. BUTTONS & UI */
        .btn-main {
            background: #ff0000;
            color: white;
            padding: 14px 32px;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }
        .btn-main:hover { background: white; color: black; transform: translateY(-2px); }

        .gray-content-area {
            background: linear-gradient(135deg, #0a0000 0%, #2a0000 100%); 
            padding: 160px 0 120px;
            margin-top: -80px;
            clip-path: polygon(0 5%, 100% 0, 100% 100%, 0 100%);
            position: relative;
            z-index: 10;
        }

        .stylist-card {
            background: rgba(0,0,0,0.5); 
            border: 1px solid rgba(255,0,0,0.1); 
            padding: 40px 20px;
            text-align: center;
            transition: 0.4s;
        }
        
        .stylist-image {
            width: 220px; height: 220px; border-radius: 50%; object-fit: cover;
            margin: 0 auto 30px; border: 6px solid #ff0000; box-shadow: 0 10px 30px rgba(255,0,0,0.2); 
        }

        .info-card {
            background: #0a0a0a; 
            padding: 40px;
            border-left: 8px solid #ff0000;
            box-shadow: 20px 20px 0px rgba(255,0,0,0.1); 
            color: white; 
        }

        .blue-quote {
            background: #1a0000; 
            border-left: 4px solid #ff0000; 
            padding: 20px;
            margin-top: 30px;
            font-weight: 700;
            color: #ffcccc; 
            font-style: italic;
        }

        .gallery-grid { display: grid; gap: 1.5rem; }
        .img-card img {
            width: 50%;
            height: 350px;
            object-fit: cover;
            transition: 0.5s;
        }
        .nav-active { border-bottom: 2px solid #ff0000; color: white !important; padding-bottom: 2px; }
        
        /* Main Content Styling */
        .about-content { background-color: #000000; padding: 60px 0; color: #fff; } 
        @media (min-width: 768px) { .about-content { padding: 80px 0; } }

        .section-title { font-size: clamp(22px, 5vw, 28px); font-weight: 950; text-transform: uppercase; margin-bottom: 15px; line-height: 1.1; }
        
        .btn-red { background-color: #ff0000; color: white; padding: 10px 25px; font-size: 11px; font-weight: 900; text-transform: uppercase; display: inline-block; transition: 0.3s; }
        .btn-red:hover { background-color: #fff; color: #000; } 
        
        /* Information Box */
        .info-line { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 12px; font-weight: 800; font-size: 13px; line-height: 1.3; }
        .info-line i { margin-top: 3px; }

        /* Mobile Menu */
        #mobile-menu { display: none; transition: 0.3s ease; }
        #mobile-menu.active { display: flex; }

        /* 5. SCROLL REVEAL TRANSITION CSS */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
            will-change: opacity, transform;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="antialiased text-white">

    <nav class="fixed-top px-8 py-5">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/woman-with-long-hair.png') }}" class="w-7 h-7 white-icon">
                <span class="font-black text-lg italic tracking-tighter">TONET SALON</span>
            </div>
            
            <div class="hidden md:flex items-center space-x-10 text-[10px] font-bold uppercase tracking-[0.2em]">
                <a href="{{ route('home') }}" class="text-red-500 border-b-2 border-red-500 pb-1">Home</a>
                <a href="{{ route('services') }}" class="hover:text-red-500 transition">Services</a>
                @auth
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin_main') : route('client_main') }}">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="opacity-70 hover:opacity-100 transition uppercase">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-red-500">Login</a>
                    <a href="{{ route('register') }}" class="bg-red-600 px-5 py-2 hover:bg-white hover:text-black transition">Join Us</a>
                @endauth
            </div>

            <button id="menu-toggle" class="md:hidden text-white text-2xl focus:outline-none z-[9999]">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <div id="mobile-menu">
        <a href="{{ route('home') }}" class="mobile-link text-red-600">Home</a>
        <a href="{{ route('services') }}" class="mobile-link">Services</a>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-main mt-10">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="mobile-link">Login</a>
            <a href="{{ route('register') }}" class="btn-main mt-10">Join Us</a>
        @endauth
    </div>

    <header class="hero-section">
        <div class="max-w-7xl mx-auto w-full px-8 relative z-10">
            <div class="max-w-2xl reveal">
                <h1 class="hero-title italic">Unveil Your<br><span class="shine-text">Shine</span></h1>
                <p class="mt-6 text-gray-400 uppercase tracking-[0.4em] text-[10px] font-bold">The Gold Standard of Hair Care</p>
                <div class="mt-10">
                    <a href="{{ route('login') }}" class="btn-main">Book Appointment</a>
                </div>
            </div>
        </div>
    </header>

    <section class="bg-black py-32 reveal">
        <div class="max-w-7xl mx-auto px-8 grid md:grid-cols-2 gap-20 items-center">
            <div class="relative">
                <img src="{{ asset('images/ahasd.png') }}" class="w-full relative z-10 shadow-2xl">
                <div class="absolute -bottom-6 -right-6 w-full h-full border-2 border-red-600 z-0"></div>
            </div>
            <div class="text-white">
                <span class="text-red-600 font-black text-xs uppercase tracking-widest">Since 2020</span>
                <h2 class="text-5xl md:text-7xl font-black uppercase leading-[0.85] mt-4 mb-8">Your Journey<br>To Beauty</h2>
                <p class="text-gray-400 text-lg leading-relaxed italic mb-10">
                    Step into Tonet Salon, where our stylists transform your look into something that brings beauty to life.
                </p>
                <a href="{{ route('services') }}" class="btn-main">View Our Services</a>
            </div>
        </div>
    </section>

    <div class="gray-content-area text-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-24 reveal">
                <h2 class="text-5xl font-black uppercase italic">Meet The <span class="text-red-600">Experts</span></h2>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 mb-40">
                <div class="stylist-card reveal">
                    <img src="{{ asset('images/tonet.png') }}" class="stylist-image">
                    <h3 class="text-2xl font-black uppercase tracking-tighter">Anthony Batac</h3>
                    <p class="text-red-600 font-bold text-xs uppercase mb-4">Owner / Creative Director</p>
                    <p class="text-sm font-medium text-gray-300 leading-loose px-10">11 years of mastery in business operations and styling since 2015.</p>
                    <a href="https://www.facebook.com/tonet.neri.batac" target="_blank" class="btn-main mt-6">Know Him More</a>
                </div>
                <div class="stylist-card reveal">
                    <img src="{{ asset('images/haha.png') }}" class="stylist-image">
                    <h3 class="text-2xl font-black uppercase tracking-tighter">Jeralyn Desphy</h3>
                    <p class="text-red-600 font-bold text-xs uppercase mb-4">Senior Technical Staff</p>
                    <p class="text-sm font-medium text-gray-300 leading-loose px-10">Veteran stylist specializing in technical services and care since 2010.</p>
                    <a href="#" class="btn-main mt-6">Know Her More</a>
                </div>
            </div>
<section class="about-content">
     <div class="gray-content-area text-white" style="background: transparent; clip-path: none; padding: 0; margin-top: 0;">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-24 reveal">
                <h2 class="text-5xl font-black uppercase italic">About <span class="text-red-600">Us</span></h2>
            </div>
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-start">
        
        <div class="reveal">
            <img src="{{ asset('images/salons.jpg') }}" alt="Tonet Salon Front" class="w-full shadow-2xl mb-8 border-4 border-red-600">
            <h2 class="section-title">A Journey of Beauty & Resilience</h2>
            <p class="font-bold text-sm leading-relaxed mb-6 text-gray-300">
                Our story began on July 18, 2020. Founded by Anthony Batac, the salon opened its doors at a time when everyone was looking for a fresh start. What started as a vision to provide quality hair care in Danao City has grown into a beloved sanctuary for beauty and self-care.
            </p>
            <a href="{{ route('services') }}" class="btn-red">View Services</a>
        </div>

        <div class="reveal">
            <div class="border-l-8 border-red-600 pl-6 mb-8">
                <h2 class="section-title">5 Years of Trusted<br>Transformations</h2>
            </div>
            <p class="font-bold text-sm leading-relaxed mb-8 text-gray-300">
                Located at the heart of Duterte St, Danao, Cebu, we have become a go-to destination for clients who value both skill and a welcoming atmosphere. Under the leadership of Anthony Batac, we have spent half a decade perfecting our craft.
            </p>
            
            <div class="info-card">
                <div class="info-line"><i class="fas fa-phone text-red-500 w-5"></i> <span>Contact: 0928 936 2396</span></div>
                <div class="info-line"><i class="fas fa-map-marker-alt text-red-600 w-5"></i> <span>Duterte St, Danao, Cebu (G2CG+7H7)</span></div>
                <div class="info-line"><i class="fas fa-user text-red-400 w-5"></i> <span>Owner: Tonet Neri Batac</span></div>
                <div class="info-line"><i class="fas fa-calendar-check text-red-400 w-5"></i> <span>Est. July 18, 2020</span></div>
                
                <div class="blue-quote">
                    "At Tonet's Salon, we don't just style hair—we boost your confidence. Come in and experience the transformation you deserve."
                </div>
            </div>
        </div>

    </div>
</section>
        </div>
    </div>

  <section class="bg-[#0a0000] py-32 overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            
            <div class="relative h-[500px] flex justify-center items-center">
                <div class="absolute w-[300px] h-[400px] bg-red-900 rounded-2xl rotate-[-6deg] translate-x-[-20px] opacity-20"></div>
                <div class="absolute w-[300px] h-[400px] bg-red-800 rounded-2xl rotate-[3deg] translate-x-[15px] opacity-20"></div>
                
                <div class="relative z-10 w-[340px] h-[440px] bg-black border border-red-900 rounded-2xl p-3 shadow-[0_25px_70px_rgba(255,0,0,0.15)]">
                    <div class="w-full h-full overflow-hidden rounded-xl bg-black">
                        <img id="main-gallery-img" src="{{ asset('images/services1.jpg') }}" 
                             class="w-full h-full object-cover transition-all duration-500">
                    </div>
                </div>
            </div>

            <div class="text-white space-y-6">
                <div class="inline-block border-l-4 border-red-600 pl-6">
                    <span class="text-red-600 font-black text-xs uppercase tracking-[0.3em]">Finished Services</span>
                    <h2 id="gallery-title" class="text-4xl md:text-5xl font-black uppercase tracking-tighter mt-2">Our Nicely Done Services</h2>
                </div>
                
                <p id="gallery-desc" class="text-gray-400 text-sm leading-relaxed italic max-w-md h-16">
                    Professional hair transformation delivered with precision and care.
                </p>

                <div class="pt-4">
                    <p class="text-[9px] uppercase tracking-[0.2em] text-gray-500 mb-4 font-bold">Select a transformation:</p>
                    <div class="grid grid-cols-6 gap-2 max-w-sm">
                        @for ($i = 1; $i <= 12; $i++)
                            <button onclick="manualSelect({{ $i - 1 }})" 
                                    class="thumb-btn border-2 border-transparent hover:border-red-600 transition-all overflow-hidden rounded-md h-12 w-full">
                                <img src="{{ asset('images/services' . $i . '.jpg') }}" class="w-full h-full object-cover opacity-60 hover:opacity-100">
                            </button>
                        @endfor
                    </div>
                </div>
                
                <div class="pt-8">
                    <a href="{{ route('login') }}" class="btn-main">Get This Look</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-black py-28 overflow-hidden text-white border-t border-red-900/50 reveal">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <div class="grid grid-cols-2 gap-4 h-[500px]">
                <div class="relative group bg-neutral-900 p-2 rounded-xl shadow-2xl transition-all duration-500 border border-neutral-800">
                    <div class="w-full h-full overflow-hidden rounded-lg">
                        <img id="display-before" src="{{ asset('images/a.jpg') }}" 
                             class="w-full h-full object-cover transition-all duration-500 grayscale group-hover:grayscale-0">
                    </div>
                    <div class="absolute top-6 left-6 bg-black/70 backdrop-blur-md text-white px-3 py-1 font-black uppercase text-[10px] tracking-widest border border-white/10">
                        Before
                    </div>
                </div>

                <div class="relative group bg-neutral-900 p-2 rounded-xl shadow-[0_25px_70px_rgba(255,0,0,0.1)] border border-red-600/20 transition-all duration-500">
                    <div class="w-full h-full overflow-hidden rounded-lg">
                        <img id="display-after" src="{{ asset('images/a1.jpg') }}" 
                             class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105">
                    </div>
                    <div class="absolute top-6 right-6 bg-red-600 text-white px-3 py-1 font-black uppercase text-[10px] tracking-widest shadow-lg">
                        After
                    </div>
                </div>
            </div>

            <div class="space-y-8 lg:pl-10">
                <div class="inline-block border-l-4 border-red-600 pl-6">
                    <span class="text-red-600 font-bold text-xs uppercase tracking-[0.3em]">Before And After Transformations</span>
                    <h2 id="transform-title" class="text-4xl md:text-5xl font-black uppercase tracking-tighter mt-2 leading-none">Our Nicely Done Services</h2>
                </div>
                
                <p id="transform-desc" class="text-gray-400 text-sm italic leading-relaxed max-w-md h-12">
                    Witness the dramatic restoration of hair health and mirror-like shine.
                </p>

                <div>
                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-4 font-black">Select a transformation:</p>
                    <div class="grid grid-cols-4 sm:grid-cols-7 gap-2">
                        @php
                            $items = [
                                ['b' => 'ba1.jpg', 'a' => 'ba2.jpg', 't' => 'Our Nicely Done Services'],
                                ['b' => 'ba3.jpg', 'a' => 'ba4.jpg', 't' => 'Our Nicely Done Services'],
                                ['b' => 'ba5.jpg', 'a' => 'ba6.jpg', 't' => 'Our Nicely Done Services'],
                                ['b' => 'ba7.jpg', 'a' => 'ba8.jpg', 't' => 'Our Nicely Done Services'],
                                ['b' => 'ba9.jpg', 'a' => 'ba10.jpg', 't' => 'Our Nicely Done Services'],
                                ['b' => 'ba11.jpg', 'a' => 'ba12.jpg', 't' => 'Our Nicely Done Services'],
                              
                            ];
                        @endphp

                        @foreach($items as $index => $item)
                        <button onclick="changeTransformation({{ $index }})" 
                                class="transform-thumb border-2 border-transparent hover:border-red-600/50 transition-all overflow-hidden rounded-lg h-16 w-full bg-neutral-900">
                            <img src="{{ asset('images/' . $item['a']) }}" class="w-full h-full object-cover opacity-50 hover:opacity-100">
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="pt-6">
                    <a href="{{ route('login') }}" class="inline-block bg-red-600 text-white font-black uppercase text-[11px] tracking-[0.2em] px-10 py-4 hover:bg-white hover:text-black transition-all duration-300 shadow-[0_10px_30px_rgba(220,38,38,0.3)]">
                        Get This Look
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .transform-thumb.active { border-color: #dc2626; box-shadow: 0 0 15px rgba(220, 38, 38, 0.4); }
    .transform-thumb.active img { opacity: 1; }
</style>

<script>
    const transformData = @json($items);

    function changeTransformation(index) {
        const item = transformData[index];
        const beforeImg = document.getElementById('display-before');
        const afterImg = document.getElementById('display-after');
        const titleText = document.getElementById('transform-title');

        [beforeImg, afterImg].forEach(el => el.style.opacity = '0');

        setTimeout(() => {
            beforeImg.src = `/images/${item.b}`;
            afterImg.src = `/images/${item.a}`;
            titleText.innerText = item.t;

            [beforeImg, afterImg].forEach(el => el.style.opacity = '1');
        }, 300);

        document.querySelectorAll('.transform-thumb').forEach((btn, i) => {
            btn.classList.toggle('active', i === index);
        });
    }

    document.addEventListener('DOMContentLoaded', () => changeTransformation(0));
</script>

<style>
    .thumb-btn.active-thumb { border-color: #ff0000; }
    .thumb-btn.active-thumb img { opacity: 1; }
</style>

<script>
    const galleryData = [
        { title: "Our Nicely Done Services", desc: "Premium rebonding for a mirror-like shine and effortless management." },
        { title: "Our Nicely Done Services", desc: "Expert color saturation that maintains hair health and vibrancy." },
        { title: "Our Nicely Done Services", desc: "A timeless, sharp cut designed for the modern professional woman." },
        { title: "Our Nicely Done Services", desc: "Technical grooming focusing on seamless blending and sharp lines." },
        { title: "Our Nicely Done Services", desc: "Sun-kissed dimension added with advanced balayage techniques." },
        { title: "Our Nicely Done Services", desc: "Intensive therapy that restores life to chemically treated hair." },
        { title: "Our Nicely Done Services", desc: "Defined, frizz-free curls using our specialized curling system." },
        { title: "Our Nicely Done Services", desc: "High-level lightening while preserving the structural integrity of the hair." },
        { title: "Our Nicely Done Services", desc: "Bold, textured short styling for a confident, low-maintenance look." },
        { title: "Our Nicely Done Services", desc: "Layered styling to provide maximum body and natural movement." },
        { title: "Our Nicely Done Services", desc: "Elegant styling for weddings and special Danao City events." },
        { title: "Our Nicely Done Services", desc: "Refreshing treatment for a healthy foundation and hair growth." }
    ];

    let currentIndex = 0;
    let autoPlayTimer;

    function updateGallery(index) {
        currentIndex = index;
        const item = galleryData[index];
        const img = document.getElementById('main-gallery-img');
        
        img.style.transform = 'scale(0.95)';
        img.style.opacity = '0.5';
        
        setTimeout(() => {
            img.src = `{{ asset('images/services') }}${index + 1}.jpg`;
            document.getElementById('gallery-title').innerText = item.title;
            document.getElementById('gallery-desc').innerText = item.desc;
            img.style.transform = 'scale(1)';
            img.style.opacity = '1';
        }, 200);

        document.querySelectorAll('.thumb-btn').forEach((btn, i) => {
            btn.classList.toggle('active-thumb', i === index);
        });
    }

    function manualSelect(index) {
        clearInterval(autoPlayTimer); 
        updateGallery(index);
        startAutoPlay(); 
    }

    function startAutoPlay() {
        autoPlayTimer = setInterval(() => {
            currentIndex = (currentIndex + 1) % galleryData.length;
            updateGallery(currentIndex);
        }, 8000); 
    }

    updateGallery(0);
    startAutoPlay();
</script>
<br>
<footer class="bg-black text-white pt-20 pb-10 relative reveal">
    <div class="absolute top-0 left-0 w-full h-[1px] bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.5)]"></div>

    <div class="max-w-7xl mx-auto px-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-16">
            <div class="mb-8 md:mb-0">
                <h2 class="text-4xl md:text-5xl font-black uppercase italic tracking-tighter leading-none">
                    Ready for seeing<br>
                    <span class="text-red-600 not-italic">A new look?</span>
                </h2>
            </div>

            <div class="flex space-x-6 text-2xl">
                <a href="#" class="hover:text-red-600 transition-colors"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-red-600 transition-colors"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-red-600 transition-colors"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-[10px] uppercase tracking-[0.2em] font-bold text-gray-500">
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <div class="bg-white p-2 rounded-sm">
                    <i class="fas fa-phone-alt text-black"></i>
                </div>
                <span>0928 936 2396</span>
            </div>

            <div class="flex space-x-8">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Updated observer to be more reliable
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px', // Triggers slightly before the element fully enters
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    // Stop observing once the animation completes to prevent re-triggering
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Target all reveal elements and observe them
        document.querySelectorAll('.reveal').forEach(el => {
            observer.observe(el);
        });

        // Mobile Menu Logic
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        if(menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
                const icon = menuToggle.querySelector('i');
                if(icon.classList.contains('fa-bars')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
        }
    });
</script>
</body>
</html>