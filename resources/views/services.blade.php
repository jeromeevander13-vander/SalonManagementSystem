<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tonet Salon | Services</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .services-header {
            background-color: #000;
            background-image: linear-gradient(to bottom, #1a1a1a 0%, #000 100%);
            padding-bottom: 60px;
        }

        .hero-title {
            font-size: clamp(2.5rem, 7vw, 5rem); 
            line-height: 0.75; 
            letter-spacing: -0.04em; 
            font-weight: 950;
            transform: scaleY(1.4); 
            transform-origin: center;
            margin: 40px 0;
        }

        .nav-active {
            border-bottom: 3px solid #ff0000; 
            padding-bottom: 2px;
        }

        .white-icon {
            filter: brightness(0) invert(1);
        }
        
        /* MOBILE MENU STYLING */
        #mobile-menu {
            display: none;
            flex-direction: column;
            background: rgba(0, 0, 0, 0.95);
            position: absolute;
            top: 70px;
            left: 0;
            width: 100%;
            z-index: 100;
            padding: 20px;
            border-bottom: 2px solid #ff0000;
        }

        #mobile-menu.active {
            display: flex;
        }

        /* Original Animations */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.2, 1, 0.3, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .service-card-container {
            display: flex;
            background-color: #cacaca; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 250px; 
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 1px solid transparent;
        }

        /* Mobile adjustment for cards */
        @media (max-width: 640px) {
            .service-card-container {
                flex-direction: column;
                height: auto;
            }
            .service-image, .service-details {
                width: 100%;
            }
            .service-image {
                height: 200px;
                border-right: none;
                border-bottom: 1px solid #bbb;
            }
        }

        .service-card-container:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            background-color: #d1d1d1;
            border-color: #ff0000;
        }

        .service-image {
            width: 50%;
            height: 100%;
            object-fit: cover;
            border-right: 1px solid #bbb;
            transition: transform 0.6s ease;
        }

        .service-card-container:hover .service-image {
            transform: scale(1.1);
        }

        .service-details {
            width: 50%;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .hidden-item { display: none !important; }

        .see-more-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            width: 100%;
        }

        .btn-see-more {
            background-color: #ff0000;
            color: white;
            padding: 12px 30px;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 2px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-see-more:hover { background-color: #000; }

        @keyframes cardAppear {
            0% { opacity: 0; transform: scale(0.9) translateY(20px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
    </style>
</head>

<body class="bg-[#efefef] font-sans antialiased">

<header class="services-header text-white">
    <nav class="max-w-7xl mx-auto w-full px-6 py-5 flex justify-between items-center relative z-30">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/woman-with-long-hair.png') }}" alt="Logo" class="w-8 h-8 object-contain white-icon">
            <span class="font-black text-xl tracking-tighter uppercase italic leading-none">TONET SALON</span>
        </div>
        
        <div class="hidden md:flex items-center space-x-8 text-[11px] font-black uppercase tracking-widest text-gray-300">
            <a href="{{ route('home') }}" class="{{ Request::is('/') ? 'text-white nav-active' : 'hover:text-white transition' }}">Home</a>
            <a href="{{ route('services') }}" class="{{ Request::is('services') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">Services</a>
            <a href="{{ route('team') }}" class="{{ Request::is('team') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">Team</a>
            <a href="{{ route('about') }}" class="{{ Request::is('about') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">About</a>
            <a href="{{ route('gallery') }}" class="{{ Request::is('gallery') ? 'text-white nav-active' : 'hover:text-red-600 transition' }}">Gallery</a>
            <a href="{{ route('register') }}" class="bg-red-600 text-white px-5 py-2 hover:bg-white hover:text-black transition">Sign Up</a>
        </div>

        <button id="menu-toggle" class="md:hidden text-white focus:outline-none text-2xl">
            <i class="fas fa-bars"></i>
        </button>

        <div id="mobile-menu" class="md:hidden">
            <a href="{{ route('home') }}" class="py-3 border-b border-gray-800 text-[10px] uppercase font-bold tracking-widest">Home</a>
            <a href="{{ route('services') }}" class="py-3 border-b border-gray-800 text-[10px] uppercase font-bold tracking-widest text-red-600">Services</a>
            <a href="{{ route('team') }}" class="py-3 border-b border-gray-800 text-[10px] uppercase font-bold tracking-widest">Team</a>
            <a href="{{ route('about') }}" class="py-3 border-b border-gray-800 text-[10px] uppercase font-bold tracking-widest">About</a>
            <a href="{{ route('gallery') }}" class="py-3 border-b border-gray-800 text-[10px] uppercase font-bold tracking-widest">Gallery</a>
            <a href="{{ route('register') }}" class="mt-4 text-center bg-red-600 py-2 text-[10px] uppercase font-bold">Sign Up</a>
        </div>
    </nav>

    <div class="text-center mt-16">
        <h1 class="hero-title uppercase italic">
            OUR PREMIUM<br>
            <span class="text-red-600 not-italic">SERVICES</span>
        </h1>
        <p class="uppercase tracking-[0.3em] text-[10px] text-gray-400 font-bold mt-10">
            Experience the magic of transformation
        </p>
    </div>
</header>

<script>
    // Toggle script for mobile menu
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('active');
        
        // Toggle between bars and X icon
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    });
</script>
    <main class="max-w-7xl mx-auto px-6 py-20">
        <h2 class="text-center text-red-600 font-black uppercase text-4xl mb-16 italic tracking-tighter" id="hair-section-title">
            Hair Color & Rebond
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10" id="services-grid"> 
            <div class="service-card-container">
                <img src="{{ asset('images/rebond1.jpg') }}" class="service-image" alt="Rebond Brazilian">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">REBOND BRAZILLIAN BOTOX:</h4>
                        <p class="text-black font-black text-lg mt-1">₱2,000.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">This is a premium "all-in-one" treatment that permanently straightens hair while using "Botox" nutrients to repair damage and add deep moisture.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container">
                <img src="{{ asset('images/rebond2.jpg') }}" class="service-image" alt="Rebond Botox Color">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">REBOND BOTOX COLOR:</h4>
                        <p class="text-black font-black text-lg mt-1">₱2,500.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">Rebond Botox Color is a premium all-in-one treatment that permanently straightens hair, repairs damage with a nutrient-rich "Botox" formula for extreme shine, and adds a fresh, vibrant color in a single session.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container">
                <img src="{{ asset('images/rebond3.jpg') }}" class="service-image" alt="Color Short">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">COLOR (SHORT):</h4>
                        <p class="text-black font-black text-lg mt-1">₱500.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">Color Short is a professional hair coloring service tailored specifically for shorter lengths to give you a vibrant, refreshed look with a clean and even finish.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container">
                <img src="{{ asset('images/rebond4.jpg') }}" class="service-image" alt="Color Long">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">COLOR (LONG):</h4>
                        <p class="text-black font-black text-lg mt-1">₱800.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A professional coloring service designed for long hair to ensure complete, even coverage and a vibrant, long-lasting shade from roots to tips..</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container">
                <img src="{{ asset('images/rebond5.jpg') }}" class="service-image" alt="Color Botox Short">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">COLOR BOTOX (SHORT):</h4>
                        <p class="text-black font-black text-lg mt-1">₱1,100.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A targeted, high-speed treatment designed for hair above the shoulders, focusing on rapid cuticle repair and quick tone refreshment..</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container">
                <img src="{{ asset('images/rebond6.jpg') }}" class="service-image" alt="Color Botox Long">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">COLOR BOTOX (LONG):</h4>
                        <p class="text-black font-black text-lg mt-1">₱1,600.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase"> An intensive, full-coverage application for hair below the shoulders, requiring more formula and time to ensure even restoration and pigment distribution from roots to ends.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container reveal extra-item hidden-item">
                <img src="{{ asset('images/rebond7.png') }}" class="service-image" alt="HIGHLIGHTS (SHORT)">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">HIGHLIGHTS (SHORT):</h4>
                        <p class="text-black font-black text-lg mt-1">₱500.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">Is a premium restorative treatment for hair above the chin that adds bright, sun-kissed dimension while using a "Botox" formula to deeply repair strands and lock in a silky, frizz-free shine.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container reveal extra-item hidden-item">
                <img src="{{ asset('images/rebond8.png') }}" class="service-image" alt="HIGHLIGHTS (LONG)">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">HIGHLIGHTS (LONG):</h4>
                        <p class="text-black font-black text-lg mt-1">₱800.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase"> Combines multi-dimensional coloring with a deep-repair treatment to give long hair vibrant depth and a frizz-free, mirror-like shine.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container reveal extra-item hidden-item">
                <img src="{{ asset('images/rebond9.png') }}" class="service-image" alt="HIGHLIGHTS COLOR BOTOX">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">HIGHLIGHTS COLOR BOTOX</h4>
                        <p class="text-black font-black text-lg mt-1">₱2,000.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A specialized repair service that neutralizes brassiness and adds high-gloss shine specifically to brighten and hydrate lightened strands.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container reveal extra-item hidden-item">
                <img src="{{ asset('images/rebond10.png') }}" class="service-image" alt="BALAYAGE BOTOX">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">BALAYAGE BOTOX:</h4>
                        <p class="text-black font-black text-lg mt-1">₱3,000.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase"> A deep-conditioning service that enhances hand-painted gradients while intensely hydrating lightened ends.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container reveal extra-item hidden-item">
                <img src="{{ asset('images/rebond11.png') }}" class="service-image" alt="BALAYAGE REBOND BOTOX">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">BALAYAGE REBOND BOTOX:</h4>
                        <p class="text-black font-black text-lg mt-1">₱4,500.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">  A dual-action service that permanently straightens hair while repairing and toning hand-painted gradients.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container reveal extra-item hidden-item">
                <img src="{{ asset('images/rebond12.png') }}" class="service-image" alt="CELLOPHANE TREATMENT">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">CELLOPHANE TREATMENT:</h4>
                        <p class="text-black font-black text-lg mt-1">₱500.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase"> A chemical-free, semi-permanent gloss that adds a protective layer of translucent color and intense shine.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container reveal extra-item hidden-item">
                <img src="{{ asset('images/rebond13.png') }}" class="service-image" alt="BRAZILLIAN BOTOX TREATMENT">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">BRAZILLIAN BOTOX TREATMENT:</h4>
                        <p class="text-black font-black text-lg mt-1">₱800.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A heavy-duty smoothing therapy that eliminates frizz and repairs fibers for a sleek, long-lasting finish.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container reveal extra-item hidden-item">
                <img src="{{ asset('images/rebond14.png') }}" class="service-image" alt="HIGHLIGHTS BOTOX SHORT">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">HIGHLIGHTS BOTOX SHORT:</h4>
                        <p class="text-black font-black text-lg mt-1">₱1,100.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A targeted repair and toning service for lightened hair above the shoulders.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container reveal extra-item hidden-item">
                <img src="{{ asset('images/rebond15.png') }}" class="service-image" alt="HIGHLIGHTS BOTOX LONG">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">HIGHLIGHTS BOTOX LONG:</h4>
                        <p class="text-black font-black text-lg mt-1">₱1,600.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A full-coverage restorative treatment to brighten and hydrate long, highlighted hair</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>
        </div> 

        <div class="see-more-wrapper">
            <button id="seeMoreBtn" class="btn-see-more">See More</button>
        </div>
    </main>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <h2 class="text-center text-red-600 font-black uppercase text-4xl mb-16 italic tracking-tighter">Other Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10"> 
            <div class="service-card-container">
                <img src="{{ asset('images/manicure1.png') }}" class="service-image" alt="PEDICURE/MANICURE">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">PEDICURE/MANICURE:</h4>
                        <p class="text-black font-black text-lg mt-1">₱100.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A manicure focuses on the hands, while a pedicure focuses on the feet. The primary goal is grooming the nails and the skin immediately surrounding them.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>
            
            <div class="service-card-container">
                <img src="{{ asset('images/footspa.png') }}" class="service-image" alt="FOOT SPA">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">FOOT SPA:</h4>
                        <p class="text-black font-black text-lg mt-1">₱300.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A foot spa is a more intensive, therapeutic treatment than a standard pedicure. While a pedicure is about the nails, a foot spa is about the entire foot up to the ankle or calf</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>
        </div>
    </main>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <h2 class="text-center text-red-600 font-black uppercase text-4xl mb-16 italic tracking-tighter">RADIO FREQUENCY SLIMMING & CONTOUR</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10"> 
            <div class="service-card-container">
                <img src="{{ asset('images/rf1.png') }}" class="service-image" alt="RF FACE">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">RF FACE:</h4>
                        <p class="text-black font-black text-sm mt-1">1 SESSION:₱229.00<br>5 SESSION:₱1,030.00<br>12 SESSION:₱2,418.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A foot spa is a more intensive, therapeutic treatment than a standard pedicure. While a pedicure is about the nails, a foot spa is about the entire foot up to the ankle or calf</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container">
                <img src="{{ asset('images/rf2.png') }}" class="service-image" alt="RF ARMS W/ CAVITATION">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">RF ARMS W/ CAVITATION:</h4>
                        <p class="text-black font-black text-sm mt-1">1 SESSION:₱429.00<br>5 SESSION:₱1,930.00<br>12 SESSION:₱4,350.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A targeted tightening treatment that uses heat to firm loose skin and sculpt the upper arms for a toned look.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>
            
            <div class="service-card-container">
                <img src="{{ asset('images/rf3.png') }}" class="service-image" alt="RF TUMMY W/ CAVITATION">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">RF TUMMY W/ CAVITATION:</h4>
                        <p class="text-black font-black text-sm mt-1">1 SESSION:₱519.00<br>5 SESSION:₱2,335.00<br>12 SESSION:₱5,480.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A non-invasive contouring service that firms the abdominal area and smooths skin for a tighter, flatter waistline.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>

            <div class="service-card-container">
                <img src="{{ asset('images/rf4.png') }}" class="service-image" alt="RF LEGS W/ CAVITATION">
                <div class="service-details">
                    <div>
                        <h4 class="font-black uppercase text-sm leading-tight">RF LEGS W/ CAVITATION:</h4>
                        <p class="text-black font-black text-sm mt-1">1 SESSION:₱519.00<br>5 SESSION:₱2,335.00<br>12 SESSION:₱5,480.00</p>
                        <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A smoothing treatment designed to reduce the appearance of cellulite and tighten skin for firmer, more contoured legs.</p>
                    </div>
                    <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
                </div>
            </div>
        </div>
    </main>

    <script>
        const seeMoreBtn = document.getElementById('seeMoreBtn');
        const extraItems = document.querySelectorAll('.extra-item');
        let isOpen = false;

        seeMoreBtn.addEventListener('click', function() {
            if (!isOpen) {
                // SHOW LOGIC
                extraItems.forEach((item, index) => {
                    item.classList.remove('hidden-item');
                    setTimeout(() => {
                        item.classList.add('active');
                        item.classList.add('pop-up-animation');
                    }, index * 100);
                });
                seeMoreBtn.textContent = 'See Less';
                isOpen = true;
            } else {
                // HIDE LOGIC
                extraItems.forEach((item) => {
                    item.classList.add('hidden-item');
                    item.classList.remove('active');
                    item.classList.remove('pop-up-animation');
                });
                
                // Scroll back to the top of the section
                document.getElementById('hair-section-title').scrollIntoView({ behavior: 'smooth' });
                
                seeMoreBtn.textContent = 'See More';
                isOpen = false;
            }
        });

        // Basic scroll reveal for initial cards
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal:not(.extra-item)').forEach(el => observer.observe(el));
    </script>
</body>
</html>

              <main class="max-w-7xl mx-auto px-6 py-20">
    <h2 class="text-center text-red-600 font-black uppercase text-4xl mb-16 italic tracking-tighter">
        EYE BROWS
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-20">
        <div class="service-card-container">
            <img src="{{ asset('images/eyebrows1.png') }}" class="service-image" alt="Micro Shading">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">MICRO SHADING:</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱1,299.00<br>
                        2 SESSION: ₱2,399.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">Creates a soft, powdered makeup look that adds fullness and definition to sparse eyebrows.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>

        <div class="service-card-container">
            <img src="{{ asset('images/eyebrows2.png') }}" class="service-image" alt="Micro Blading">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">MICRO BLADING/OMBRE:</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱1,299.00<br>
                        2 SESSION: ₱2,399.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">Uses fine strokes or shading to create natural-looking hair or a trendy gradient finish.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>

        <div class="service-card-container">
            <img src="{{ asset('images/eyebrows3.png') }}" class="service-image" alt="Combo Brow">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">COMBROW:</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱2,099.00<br>
                        2 SESSION: ₱3,999.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">The ultimate hybrid of blading and shading for maximum dimension, thickness, and a long-lasting shape.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>

        <div class="service-card-container">
            <img src="{{ asset('images/eyebrows4.png') }}" class="service-image" alt="Brows Lamination">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">BROWS LAMINATION:</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱349.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A "perm" for your brows that realigns the hair to look fuller, fluffier, and perfectly groomed.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>

        <div class="service-card-container md:col-span-2 md:max-w-[50%] md:mx-auto">
            <img src="{{ asset('images/eyebrows5.png') }}" class="service-image" alt="Eyebrow Threading">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">EYEBROW THREADING:</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱50.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A precise hair removal technique that uses a thin thread to create a clean, sharp brow arch.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>
    </div>

    <h2 class="text-center text-red-600 font-black uppercase text-4xl mb-16 italic tracking-tighter">
        OTHERS
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-20">
        <div class="service-card-container">
            <img src="{{ asset('images/lips.png') }}" class="service-image" alt="Lip Blush">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">LIP BLUSH:</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱1,299.00<br>
                        2 SESSION: ₱2,399.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A semi-permanent tint that enhances your natural lip color and shape for a soft, "just-bitten" flush.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>

        <div class="service-card-container">
            <img src="{{ asset('images/wartspng.png') }}" class="service-image" alt="Warts Removal">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">WARTS REMOVAL:</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱199.00<br>
                        2 SESSION: ₱349.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A quick and safe procedure to effectively eliminate skin warts for a clearer, smoother complexion.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>
    </div>

    <h2 class="text-center text-red-600 font-black uppercase text-4xl mb-16 italic tracking-tighter">
        MESO LIPOSUCTION
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="service-card-container">
            <img src="{{ asset('images/meso1.png') }}" class="service-image" alt="Meso Lipo Face">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">MESO LIPO FACE (FREE RF):</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱429.00<br>
                        5 SESSION: ₱1,930.00<br>
                        12 SESSION: ₱4,536.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A non-surgical fat-melting injection that slims the face and jawline, paired with RF to tighten the skin.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>

        <div class="service-card-container">
            <img src="{{ asset('images/meso2.png') }}" class="service-image" alt="Meso Lipo Arms">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">MESO LIPO ARMS (FREE RF):</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱629.00<br>
                        5 SESSION: ₱2,830.00<br>
                        12 SESSION: ₱6,042.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">Targets stubborn arm fat with localized injections and RF to eliminate flab and sculpt a leaner look.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>

        <div class="service-card-container">
            <img src="{{ asset('images/meso3.png') }}" class="service-image" alt="Meso Lipo Tummy">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">MESO LIPO TUMMY (FREE RF):</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱729.00<br>
                        5 SESSION: ₱3,235.00<br>
                        12 SESSION: ₱7,582.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">A powerful treatment to dissolve abdominal fat and tighten the stomach area for a flatter silhouette.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>

        <div class="service-card-container">
            <img src="{{ asset('images/meso4.png') }}" class="service-image" alt="Meso Lipo Legs">
            <div class="service-details">
                <div>
                    <h4 class="font-black uppercase text-sm leading-tight">MESO LIPO LEGS (FREE RF):</h4>
                    <p class="text-black font-black text-sm mt-1">
                        1 SESSION: ₱729.00<br>
                        5 SESSION: ₱3,235.00<br>
                        12 SESSION: ₱7,582.00
                    </p>
                    <p class="text-[10px] text-gray-800 font-bold mt-3 leading-tight uppercase">Specifically designed to melt fat in the thighs and calves while smoothing skin texture with RF.</p>
                </div>
                <a href="/login" class="bg-red-600 text-white text-[10px] font-black py-3 uppercase tracking-widest text-center hover:bg-black transition duration-300">Book Now</a>
            </div>
        </div>
    </div>
</main>

   <footer class="bg-black text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
            <h2 class="text-4xl md:text-5xl font-black italic uppercase leading-none tracking-tighter">
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
                <a href="tel:09289362396" class="text-[11px] font-extrabold text-gray-400 hover:text-white transition tracking-widest">
                    09289362396
                </a>
            </div>
            
            <div class="flex gap-8">
                <a href="#" class="text-[10px] font-extrabold uppercase tracking-widest text-gray-400 hover:text-white transition">
                    Privacy Policy
                </a>
                <a href="#" class="text-[10px] font-extrabold uppercase tracking-widest text-gray-400 hover:text-white transition">
                    Terms & Conditions
                </a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>