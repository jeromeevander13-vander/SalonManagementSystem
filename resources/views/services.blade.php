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

        /* Card Container Base */
    .service-card-container {
        display: flex;
        flex-direction: column; /* Stacked by default (Mobile) */
        background: white;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    /* Professional Image Handling */
    .service-image {
        width: 100%;
        height: 250px; /* Fixed height for uniformity */
        object-fit: cover; /* Prevents stretching/squashing */
        object-position: center;
    }

    /* Details Area */
    .service-details {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }

    /* Desktop adjustment: Side-by-side layout */
    @media (min-width: 768px) {
        .service-card-container {
            flex-direction: row; /* Side-by-side on desktop */
            height: 300px;
        }
        .service-image {
            width: 40%; /* Image takes 40% width on desktop */
            height: 100%;
        }
        .service-details {
            width: 60%;
        }
    }

    /* Hidden items for the 'See More' logic */
    .hidden-item {
        display: none !important;
    }

    /* 1. Ensure the Grid behaves on Mobile */
    #services-grid {
        display: grid !important;
        grid-template-cols: 1fr !important; /* Forces one column on mobile */
        gap: 2rem !important;
    }

    /* 2. Fix the Visibility Logic */
    /* Ensure hidden-item actually hides, but doesn't break the layout when shown */
    .hidden-item {
        display: none !important; 
    }

    /* When the JS removes 'hidden-item' and adds 'active', ensure it uses Flex */
    .service-card-container.active {
        display: flex !important; /* This overrides the 'none' display */
    }

    /* 3. Mobile Card Layout (Style Only) */
    @media (max-width: 768px) {
        .service-card-container {
            flex-direction: column !important; /* Stacks image over text */
            width: 100% !important;
            min-height: auto !important;
        }

        .service-image {
            width: 100% !important;
            height: 250px !important;
            object-fit: cover;
        }

        .service-details {
            width: 100% !important;
            padding: 20px !important;
            text-align: left !important; /* Fixes the squeezed center-align */
        }

        /* Enhancing the tiny description text */
        .service-details p.text-[10px] {
            font-size: 14px !important; /* Larger for mobile eyes */
            line-height: 1.5 !important;
            text-transform: none !important; /* Easier to read than all-caps */

        }
        
        /* Mobile Menu */
        #mobile-menu { display: none; transition: 0.3s ease; }
        #mobile-menu.active { display: flex; }

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
           

            
                @auth
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin_main') : route('client_main') }}" class="hover:text-red-600 transition">Dashboard</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline m-0">
                        @csrf
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 hover:bg-red-600 transition uppercase font-bold text-[10px]">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-red-600 transition">Login</a>
                      <a href="{{ route('register') }}" class="bg-red-600 px-5 py-2 hover:bg-white hover:text-black transition">Join Us</a>
                @endauth
        </div>
        
        

        <button id="menu-toggle" class="md:hidden text-white focus:outline-none text-2xl">
            <i class="fas fa-bars"></i>
        </button>

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
            <a href="{{ route('register') }}" class="btn-main mt-10">Join Us </a>
        @endauth
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
    <main class="bg-[#0b0b0b] min-h-screen text-white font-sans py-12 px-4 md:px-10 overflow-x-hidden">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex items-start gap-4 mb-16 animate-slide-in">
            <div class="w-1 h-20 bg-red-600"></div>
            <div>
               
                <div class="flex flex-col items-center justify-center text-center w-full mb-20 animate-slide-in">
            <h2 class="text-6xl md:text-6xl font-black uppercase tracking-tighter leading-none italic">
                Hair Color &<br><span class="text-red-600">Rebond</span>
            </h2>
            <div class="w-32 h-1.5 bg-red-600 mt-8 shadow-[0_0_20px_rgba(220,38,38,0.4)]"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start bg-black p-8 rounded-xl border border-zinc-800 mb-20 shadow-[0_20px_50px_rgba(0,0,0,0.9)] relative overflow-hidden">
            
            <div class="lg:col-span-5 relative overflow-hidden rounded-2xl bg-zinc-900 border border-white/10 group">
                <div id="image-slider" class="relative w-full aspect-[4/5] transition-all duration-500 ease-in-out">
                    <img src="{{ asset('images/rebond1.jpg') }}" id="main-display-image" 
                         class="w-full h-full object-cover rounded-xl" 
                         alt="Main transformation">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-600/10 to-transparent pointer-events-none"></div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col h-full py-2">
                <div id="text-slider" class="transition-all duration-500 ease-in-out">
                    <h3 id="display-title" class="text-3xl font-black uppercase italic tracking-tighter mb-2 text-red-600">REBOND BRAZILLIAN BOTOX</h3>
                    <p id="display-price" class="text-2xl font-black mb-6 text-white tracking-widest">₱2,000.00</p>
                    
                    <p id="display-desc" class="text-zinc-400 italic text-lg mb-10 min-h-[140px] leading-relaxed border-l-2 border-zinc-800 pl-4">
                        This is a premium "all-in-one" treatment that permanently straightens hair while using "Botox" nutrients to repair damage and add deep moisture.
                    </p>
                </div>

                <div class="mt-auto">
                    <h3 class="uppercase text-[10px] font-bold tracking-widest text-zinc-500 mb-4 flex items-center gap-2">
                        Select a Transformation <span class="w-10 h-[1px] bg-zinc-800"></span>
                    </h3>
                    
                    <div class="grid grid-cols-5 md:grid-cols-8 gap-2 mb-10">
                        @php
                        $services = [
                            ['rebond1.jpg', 'REBOND BRAZILLIAN BOTOX', '₱2,000.00', 'This is a premium "all-in-one" treatment that permanently straightens hair while using "Botox" nutrients to repair damage and add deep moisture.'],
                            ['rebond2.jpg', 'REBOND BOTOX COLOR', '₱2,500.00', 'Rebond Botox Color is a premium all-in-one treatment that permanently straightens hair, repairs damage, and adds a fresh, vibrant color.'],
                            ['rebond3.jpg', 'COLOR (SHORT)', '₱500.00', 'Professional hair coloring tailored specifically for shorter lengths to give you a vibrant, refreshed look.'],
                            ['rebond4.jpg', 'COLOR (LONG)', '₱800.00', 'A professional coloring service designed for long hair to ensure complete, even coverage and a vibrant, long-lasting shade.'],
                            ['rebond5.jpg', 'COLOR BOTOX (SHORT)', '₱1,100.00', 'Targeted, high-speed treatment for hair above the shoulders, focusing on rapid cuticle repair and color vibrancy.'],
                            ['rebond6.jpg', 'COLOR BOTOX (LONG)', '₱1,600.00', 'Intensive, full-coverage application for hair below the shoulders ensuring even restoration and deep color penetration.'],
                            ['rebond7.png', 'HIGHLIGHTS (SHORT)', '₱500.00', 'Restorative treatment for hair above the chin that adds bright dimension and repairs strands for a sun-kissed look.'],
                            ['rebond8.png', 'HIGHLIGHTS (LONG)', '₱800.00', 'Combines multi-dimensional coloring with a deep-repair treatment to give long hair vibrant depth and shine.'],
                            ['rebond9.png', 'HIGHLIGHTS COLOR BOTOX', '₱2,000.00', 'Neutralizes brassiness and adds high-gloss shine specifically to brighten lightened strands while repairing fibers.'],
                            ['rebond10.png', 'BALAYAGE BOTOX', '₱3,000.00', 'A deep-conditioning service that enhances hand-painted gradients while intensely hydrating ends for a natural flow.'],
                            ['rebond11.png', 'BALAYAGE REBOND BOTOX', '₱4,500.00', 'A dual-action service that permanently straightens hair while repairing hand-painted gradients for maximum sleekness.'],
                            ['rebond12.png', 'CELLOPHANE TREATMENT', '₱500.00', 'A chemical-free, semi-permanent gloss that adds a protective layer of translucent color and intense shine.'],
                            ['rebond13.png', 'BRAZILLIAN BOTOX TREATMENT', '₱800.00', 'A heavy-duty smoothing therapy that eliminates frizz and repairs fibers for a sleek, manageable finish.'],
                            ['rebond14.png', 'HIGHLIGHTS BOTOX SHORT', '₱1,100.00', 'A targeted repair and toning service for lightened hair above the shoulders, restoring health to every strand.'],
                            ['rebond15.png', 'HIGHLIGHTS BOTOX LONG', '₱1,600.00', 'A full-coverage restorative treatment to brighten and hydrate long, highlighted hair for a professional finish.']
                        ];
                        @endphp

                        @foreach($services as $index => $service)
                        <button onclick="updateDisplaySlide('{{ $service[0] }}', '{{ addslashes($service[1]) }}', '{{ $service[2] }}', '{{ addslashes($service[3]) }}')" 
                                class="thumb-btn relative aspect-square border-2 {{ $index === 0 ? 'border-red-600' : 'border-transparent' }} rounded overflow-hidden transition-all duration-300 hover:scale-110 hover:z-10 shadow-md">
                            <img src="{{ asset('images/' . $service[0]) }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all">
                        </button>
                        @endforeach
                    </div>

                    <a href="/login" class="relative overflow-hidden group inline-block bg-red-600 text-white font-black py-4 px-12 uppercase tracking-widest transition-all duration-300">
                        <span class="relative z-10 group-hover:text-black transition-colors duration-300">Get This Look</span>
                        <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                </div>
            </div>
        </div>

</main>

<style>
    /* Custom Entrance Animations */
    @keyframes slideInLeft {
        from { transform: translateX(-30px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    .animate-slide-in { animation: slideInLeft 0.8s ease-out forwards; }

    /* Performance optimization for sliders */
    #image-slider, #text-slider {
        will-change: transform, opacity;
    }

    /* Selection Highlighting */
    .thumb-btn.border-red-600 img { filter: grayscale(0); }
</style>

<script>
    function updateDisplaySlide(imageName, title, price, description) {
        const imgSlider = document.getElementById('image-slider');
        const textSlider = document.getElementById('text-slider');
        
        // 1. Swipe Out (Exit to the left)
        imgSlider.style.transform = 'translateX(-115%)';
        imgSlider.style.opacity = '0';
        textSlider.style.transform = 'translateX(-30px)';
        textSlider.style.opacity = '0';
        
        setTimeout(() => {
            // 2. Prepare Entry (Snap to the right instantly while invisible)
            imgSlider.style.transition = 'none';
            imgSlider.style.transform = 'translateX(115%)';
            textSlider.style.transition = 'none';
            textSlider.style.transform = 'translateX(30px)';

            // Update Content Data
            document.getElementById('main-display-image').src = `{{ asset('images/') }}/${imageName}`;
            document.getElementById('display-title').innerText = title;
            document.getElementById('display-price').innerText = price;
            document.getElementById('display-desc').innerText = description;

            // 3. Swipe In (Enter from the right)
            setTimeout(() => {
                imgSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                imgSlider.style.transform = 'translateX(0)';
                imgSlider.style.opacity = '1';
                
                textSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                textSlider.style.transform = 'translateX(0)';
                textSlider.style.opacity = '1';
            }, 50);
        }, 350);

        // Update Thumbnail Borders
        document.querySelectorAll('.thumb-btn').forEach(btn => {
            btn.classList.remove('border-red-600');
            btn.classList.add('border-transparent');
        });
        const currentBtn = event.currentTarget;
        currentBtn.classList.add('border-red-600');
        currentBtn.classList.remove('border-transparent');
    }
</script>

 <main class="bg-[#0b0b0b] min-h-screen text-white font-sans py-12 px-4 md:px-10 overflow-x-hidden">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col items-center justify-center text-center w-full mb-20 animate-slide-in">
            <h2 class="text-6xl md:text-6xl font-black uppercase tracking-tighter leading-none italic">
                Other<br><span class="text-red-600">Services</span>
            </h2>
            <div class="w-32 h-1.5 bg-red-600 mt-8 shadow-[0_0_20px_rgba(220,38,38,0.4)]"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start bg-black p-8 rounded-xl border border-zinc-800 mb-20 shadow-[0_20px_60px_rgba(0,0,0,1)] relative overflow-hidden">
            
            <div class="lg:col-span-5 relative overflow-hidden rounded-2xl bg-zinc-900 border border-white/10 group">
                <div id="other-image-slider" class="relative w-full aspect-[4/5] transition-all duration-500 ease-in-out">
                    <img src="{{ asset('images/manicure1.png') }}" id="other-display-image" 
                         class="w-full h-full object-cover rounded-xl" 
                         alt="Nail Service">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-600/10 to-transparent pointer-events-none"></div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col h-full py-2">
                <div id="other-text-slider" class="transition-all duration-500 ease-in-out">
                    <h3 id="other-display-title" class="text-4xl font-black uppercase italic tracking-tighter mb-2 text-red-600">PEDICURE/MANICURE</h3>
                    <div id="other-display-pricing" class="mb-6">
                        <p class="text-4xl font-black text-white tracking-widest uppercase">₱100.00</p>
                    </div>
                    
                    <p id="other-display-desc" class="text-zinc-400 italic text-lg mb-10 min-h-[120px] leading-relaxed border-l-4 border-red-600 pl-6 uppercase">
                        A manicure focuses on the hands, while a pedicure focuses on the feet. The primary goal is grooming the nails and the skin immediately surrounding them.
                    </p>
                </div>

                <div class="mt-auto">
                    <h3 class="uppercase text-[11px] font-bold tracking-[0.3em] text-zinc-500 mb-6 flex items-center gap-4">
                        Select Treatment <span class="flex-grow h-[1px] bg-zinc-800"></span>
                    </h3>
                    
                    <div class="grid grid-cols-4 md:grid-cols-6 gap-3 mb-10">
                        @php
                        $other_services = [
                            ['manicure1.png', 'PEDICURE/MANICURE', '₱100.00', 'A manicure focuses on the hands, while a pedicure focuses on the feet. The primary goal is grooming the nails and the skin immediately surrounding them.'],
                            ['footspa.png', 'FOOT SPA', '₱300.00', 'A foot spa is a more intensive, therapeutic treatment than a standard pedicure. While a pedicure is about the nails, a foot spa is about the entire foot up to the ankle or calf.']
                        ];
                        @endphp

                        @foreach($other_services as $index => $item)
                        <button onclick="updateOtherDisplay('{{ $item[0] }}', '{{ addslashes($item[1]) }}', '{{ addslashes($item[2]) }}', '{{ addslashes($item[3]) }}')" 
                                class="other-thumb-btn relative aspect-square border-2 {{ $index === 0 ? 'border-red-600' : 'border-transparent' }} rounded overflow-hidden transition-all duration-300 hover:scale-110 hover:z-20">
                            <img src="{{ asset('images/' . $item[0]) }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all">
                        </button>
                        @endforeach
                    </div>

                    <a href="/login" class="relative overflow-hidden group inline-block bg-red-600 text-white font-black py-5 px-14 uppercase tracking-[0.2em] transition-all duration-300">
                        <span class="relative z-10 group-hover:text-black transition-colors duration-300">Book Service</span>
                        <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function updateOtherDisplay(imgName, title, price, desc) {
        const imgSlider = document.getElementById('other-image-slider');
        const textSlider = document.getElementById('other-text-slider');
        
        // Swipe Out
        imgSlider.style.transform = 'translateX(-115%)';
        imgSlider.style.opacity = '0';
        textSlider.style.transform = 'translateX(-40px)';
        textSlider.style.opacity = '0';
        
        setTimeout(() => {
            imgSlider.style.transition = 'none';
            imgSlider.style.transform = 'translateX(115%)';
            textSlider.style.transition = 'none';
            textSlider.style.transform = 'translateX(40px)';

            // Update Content
            document.getElementById('other-display-image').src = `{{ asset('images/') }}/${imgName}`;
            document.getElementById('other-display-title').innerText = title;
            document.getElementById('other-display-pricing').innerHTML = `<p class="text-4xl font-black text-white tracking-widest uppercase">${price}</p>`;
            document.getElementById('other-display-desc').innerText = desc;

            // Swipe In
            setTimeout(() => {
                imgSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                imgSlider.style.transform = 'translateX(0)';
                imgSlider.style.opacity = '1';
                
                textSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                textSlider.style.transform = 'translateX(0)';
                textSlider.style.opacity = '1';
            }, 50);
        }, 350);

        // Update active thumbnail
        document.querySelectorAll('.other-thumb-btn').forEach(btn => {
            btn.classList.remove('border-red-600');
            btn.classList.add('border-transparent');
        });
        event.currentTarget.classList.add('border-red-600');
    }
</script>

    <main class="bg-[#0b0b0b] min-h-screen text-white font-sans py-12 px-4 md:px-10 overflow-x-hidden">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col items-center justify-center text-center w-full mb-20 animate-slide-in">
            <h2 class="text-6xl md:text-6xl font-black uppercase tracking-tighter leading-none italic">
                Slimming &<br><span class="text-red-600">Contour</span>
            </h2>
            <div class="w-32 h-1.5 bg-red-600 mt-8 shadow-[0_0_20px_rgba(220,38,38,0.4)]"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start bg-black p-8 rounded-xl border border-zinc-800 mb-20 shadow-[0_20px_60px_rgba(0,0,0,1)] relative overflow-hidden">
            
            <div class="lg:col-span-5 relative overflow-hidden rounded-2xl bg-zinc-900 border border-white/10 group">
                <div id="rf-image-slider" class="relative w-full aspect-[4/5] transition-all duration-500 ease-in-out">
                    <img src="{{ asset('images/rf1.png') }}" id="rf-display-image" 
                         class="w-full h-full object-cover rounded-xl" 
                         alt="RF Service">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-600/10 to-transparent pointer-events-none"></div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col h-full py-2">
                <div id="rf-text-slider" class="transition-all duration-500 ease-in-out">
                    <h3 id="rf-display-title" class="text-4xl font-black uppercase italic tracking-tighter mb-2 text-red-600">RF FACE</h3>
                    <div id="rf-display-pricing" class="mb-6 space-y-1">
                        <p class="text-2xl font-black text-white tracking-widest uppercase">1 Session: ₱229.00</p>
                        <p class="text-xl font-bold text-zinc-400 tracking-widest uppercase">5 Sessions: ₱1,030.00</p>
                        <p class="text-xl font-bold text-zinc-400 tracking-widest uppercase">12 Sessions: ₱2,418.00</p>
                    </div>
                    
                    <p id="rf-display-desc" class="text-zinc-400 italic text-lg mb-10 min-h-[120px] leading-relaxed border-l-4 border-red-600 pl-6 uppercase">
                        A focused radio frequency treatment designed to tighten skin and improve facial contours for a rejuvenated look.
                    </p>
                </div>

                <div class="mt-auto">
                    <h3 class="uppercase text-[11px] font-bold tracking-[0.3em] text-zinc-500 mb-6 flex items-center gap-4">
                        Select a Target Area <span class="flex-grow h-[1px] bg-zinc-800"></span>
                    </h3>
                    
                    <div class="grid grid-cols-4 md:grid-cols-6 gap-3 mb-10">
                        @php
                        $rf_services = [
                            ['rf1.png', 'RF FACE', '1 Session: ₱229.00<br>5 Sessions: ₱1,030.00<br>12 Sessions: ₱2,418.00', 'A focused radio frequency treatment designed to tighten skin and improve facial contours for a rejuvenated look.'],
                            ['rf2.png', 'RF ARMS W/ CAVITATION', '1 Session: ₱429.00<br>5 Sessions: ₱1,930.00<br>12 Sessions: ₱4,350.00', 'A targeted tightening treatment that uses heat to firm loose skin and sculpt the upper arms for a toned look.'],
                            ['rf3.png', 'RF TUMMY W/ CAVITATION', '1 Session: ₱519.00<br>5 Sessions: ₱2,335.00<br>12 Sessions: ₱5,480.00', 'A non-invasive contouring service that firms the abdominal area and smooths skin for a tighter, flatter waistline.'],
                            ['rf4.png', 'RF LEGS W/ CAVITATION', '1 Session: ₱519.00<br>5 Sessions: ₱2,335.00<br>12 Sessions: ₱5,480.00', 'A smoothing treatment designed to reduce the appearance of cellulite and tighten skin for firmer, more contoured legs.']
                        ];
                        @endphp

                        @foreach($rf_services as $index => $item)
                        <button onclick="updateRFDisplay('{{ $item[0] }}', '{{ addslashes($item[1]) }}', '{{ addslashes($item[2]) }}', '{{ addslashes($item[3]) }}')" 
                                class="rf-thumb-btn relative aspect-square border-2 {{ $index === 0 ? 'border-red-600' : 'border-transparent' }} rounded overflow-hidden transition-all duration-300 hover:scale-110 hover:z-20">
                            <img src="{{ asset('images/' . $item[0]) }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all">
                        </button>
                        @endforeach
                    </div>

                    <a href="/login" class="relative overflow-hidden group inline-block bg-red-600 text-white font-black py-5 px-14 uppercase tracking-[0.2em] transition-all duration-300">
                        <span class="relative z-10 group-hover:text-black transition-colors duration-300">Book Session</span>
                        <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function updateRFDisplay(imgName, title, pricing, desc) {
        const imgSlider = document.getElementById('rf-image-slider');
        const textSlider = document.getElementById('rf-text-slider');
        
        // Swipe Out
        imgSlider.style.transform = 'translateX(-115%)';
        imgSlider.style.opacity = '0';
        textSlider.style.transform = 'translateX(-40px)';
        textSlider.style.opacity = '0';
        
        setTimeout(() => {
            // Prep Entry
            imgSlider.style.transition = 'none';
            imgSlider.style.transform = 'translateX(115%)';
            textSlider.style.transition = 'none';
            textSlider.style.transform = 'translateX(40px)';

            // Update Content
            document.getElementById('rf-display-image').src = `{{ asset('images/') }}/${imgName}`;
            document.getElementById('rf-display-title').innerText = title;
            document.getElementById('rf-display-pricing').innerHTML = pricing.split('<br>').map((p, i) => 
                `<p class="${i === 0 ? 'text-2xl text-white' : 'text-xl text-zinc-400'} font-black tracking-widest uppercase">${p}</p>`
            ).join('');
            document.getElementById('rf-display-desc').innerText = desc;

            // Swipe In
            setTimeout(() => {
                imgSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                imgSlider.style.transform = 'translateX(0)';
                imgSlider.style.opacity = '1';
                
                textSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                textSlider.style.transform = 'translateX(0)';
                textSlider.style.opacity = '1';
            }, 50);
        }, 350);

        // Update Thumbnails
        document.querySelectorAll('.rf-thumb-btn').forEach(btn => {
            btn.classList.remove('border-red-600');
            btn.classList.add('border-transparent');
        });
        event.currentTarget.classList.add('border-red-600');
    }
</script>
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


 <main class="bg-[#0b0b0b] min-h-screen text-white font-sans py-12 px-4 md:px-10 overflow-x-hidden">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col items-center justify-center text-center w-full mb-20 animate-slide-in">
            <h2 class="text-6xl md:text-6xl font-black uppercase tracking-tighter leading-none italic">
                Precision<br><span class="text-red-600">Eyebrows</span>
            </h2>
            <div class="w-32 h-1.5 bg-red-600 mt-8 shadow-[0_0_20px_rgba(220,38,38,0.4)]"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start bg-black p-8 rounded-xl border border-zinc-800 mb-20 shadow-[0_20px_60px_rgba(0,0,0,1)] relative overflow-hidden">
            
            <div class="lg:col-span-5 relative overflow-hidden rounded-2xl bg-zinc-900 border border-white/10 group">
                <div id="eb-image-slider" class="relative w-full aspect-[4/5] transition-all duration-500 ease-in-out">
                    <img src="{{ asset('images/eyebrows1.png') }}" id="eb-display-image" 
                         class="w-full h-full object-cover rounded-xl" 
                         alt="Eyebrow Service">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-600/10 to-transparent pointer-events-none"></div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col h-full py-2">
                <div id="eb-text-slider" class="transition-all duration-500 ease-in-out">
                    <h3 id="eb-display-title" class="text-4xl font-black uppercase italic tracking-tighter mb-2 text-red-600">MICRO SHADING</h3>
                    <div id="eb-display-pricing" class="mb-6 space-y-1">
                        <p class="text-2xl font-black text-white tracking-widest uppercase">1 Session: ₱1,299.00</p>
                        <p class="text-xl font-bold text-zinc-400 tracking-widest uppercase">2 Sessions: ₱2,399.00</p>
                    </div>
                    
                    <p id="eb-display-desc" class="text-zinc-400 italic text-lg mb-10 min-h-[120px] leading-relaxed border-l-4 border-red-600 pl-6 uppercase">
                        Creates a soft, powdered makeup look that adds fullness and definition to sparse eyebrows.
                    </p>
                </div>

                <div class="mt-auto">
                    <h3 class="uppercase text-[11px] font-bold tracking-[0.3em] text-zinc-500 mb-6 flex items-center gap-4">
                        Select a Technique <span class="flex-grow h-[1px] bg-zinc-800"></span>
                    </h3>
                    
                    <div class="grid grid-cols-5 gap-3 mb-10">
                        @php
                        $eb_services = [
                            ['eyebrows1.png', 'MICRO SHADING', '1 Session: ₱1,299.00<br>2 Sessions: ₱2,399.00', 'Creates a soft, powdered makeup look that adds fullness and definition to sparse eyebrows.'],
                            ['eyebrows2.png', 'MICRO BLADING/OMBRE', '1 Session: ₱1,299.00<br>2 Sessions: ₱2,399.00', 'Uses fine strokes or shading to create natural-looking hair or a trendy gradient finish.'],
                            ['eyebrows3.png', 'COMBROW', '1 Session: ₱2,099.00<br>2 Sessions: ₱3,999.00', 'The ultimate hybrid of blading and shading for maximum dimension, thickness, and a long-lasting shape.'],
                            ['eyebrows4.png', 'BROWS LAMINATION', '1 Session: ₱349.00', 'A "perm" for your brows that realigns the hair to look fuller, fluffier, and perfectly groomed.'],
                            ['eyebrows5.png', 'EYEBROW THREADING', '1 Session: ₱50.00', 'A precise hair removal technique that uses a thin thread to create a clean, sharp brow arch.']
                        ];
                        @endphp

                        @foreach($eb_services as $index => $item)
                        <button onclick="updateEBDisplay('{{ $item[0] }}', '{{ addslashes($item[1]) }}', '{{ addslashes($item[2]) }}', '{{ addslashes($item[3]) }}')" 
                                class="eb-thumb-btn relative aspect-square border-2 {{ $index === 0 ? 'border-red-600' : 'border-transparent' }} rounded overflow-hidden transition-all duration-300 hover:scale-110 hover:z-20 shadow-md">
                            <img src="{{ asset('images/' . $item[0]) }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all">
                        </button>
                        @endforeach
                    </div>

                    <a href="/login" class="relative overflow-hidden group inline-block bg-red-600 text-white font-black py-5 px-14 uppercase tracking-[0.2em] transition-all duration-300">
                        <span class="relative z-10 group-hover:text-black transition-colors duration-300">Book Session</span>
                        <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function updateEBDisplay(imgName, title, pricing, desc) {
        const imgSlider = document.getElementById('eb-image-slider');
        const textSlider = document.getElementById('eb-text-slider');
        
        // Swipe Out Animation
        imgSlider.style.transform = 'translateX(-115%)';
        imgSlider.style.opacity = '0';
        textSlider.style.transform = 'translateX(-40px)';
        textSlider.style.opacity = '0';
        
        setTimeout(() => {
            // Position for Entry
            imgSlider.style.transition = 'none';
            imgSlider.style.transform = 'translateX(115%)';
            textSlider.style.transition = 'none';
            textSlider.style.transform = 'translateX(40px)';

            // Update Dynamic Content
            document.getElementById('eb-display-image').src = `{{ asset('images/') }}/${imgName}`;
            document.getElementById('eb-display-title').innerText = title;
            document.getElementById('eb-display-pricing').innerHTML = pricing.split('<br>').map((p, i) => 
                `<p class="${i === 0 ? 'text-2xl text-white' : 'text-xl text-zinc-400'} font-black tracking-widest uppercase">${p}</p>`
            ).join('');
            document.getElementById('eb-display-desc').innerText = desc;

            // Swipe In Animation
            setTimeout(() => {
                imgSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                imgSlider.style.transform = 'translateX(0)';
                imgSlider.style.opacity = '1';
                
                textSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                textSlider.style.transform = 'translateX(0)';
                textSlider.style.opacity = '1';
            }, 50);
        }, 350);

        // Update Thumbnail Visuals
        document.querySelectorAll('.eb-thumb-btn').forEach(btn => {
            btn.classList.remove('border-red-600');
            btn.classList.add('border-transparent');
        });
        event.currentTarget.classList.add('border-red-600');
    }
</script>

    <main class="bg-[#0b0b0b] min-h-screen text-white font-sans py-12 px-4 md:px-10 overflow-x-hidden">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col items-center justify-center text-center w-full mb-20 animate-slide-in">
            <h2 class="text-6xl md:text-6xl font-black uppercase tracking-tighter leading-none italic">
                Beauty<br><span class="text-red-600">Essentials</span>
            </h2>
            <div class="w-32 h-1.5 bg-red-600 mt-8 shadow-[0_0_20px_rgba(220,38,38,0.4)]"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start bg-black p-8 rounded-xl border border-zinc-800 mb-20 shadow-[0_20px_60px_rgba(0,0,0,1)] relative overflow-hidden">
            
            <div class="lg:col-span-5 relative overflow-hidden rounded-2xl bg-zinc-900 border border-white/10 group">
                <div id="misc-image-slider" class="relative w-full aspect-[4/5] transition-all duration-500 ease-in-out">
                    <img src="{{ asset('images/lips.png') }}" id="misc-display-image" 
                         class="w-full h-full object-cover rounded-xl" 
                         alt="Beauty Service">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-600/10 to-transparent pointer-events-none"></div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col h-full py-2">
                <div id="misc-text-slider" class="transition-all duration-500 ease-in-out">
                    <h3 id="misc-display-title" class="text-4xl font-black uppercase italic tracking-tighter mb-2 text-red-600">LIP BLUSH</h3>
                    <div id="misc-display-pricing" class="mb-6 space-y-1">
                        <p class="text-2xl font-black text-white tracking-widest uppercase">1 Session: ₱1,299.00</p>
                        <p class="text-xl font-bold text-zinc-400 tracking-widest uppercase">2 Sessions: ₱2,399.00</p>
                    </div>
                    
                    <p id="misc-display-desc" class="text-zinc-400 italic text-lg mb-10 min-h-[120px] leading-relaxed border-l-4 border-red-600 pl-6 uppercase">
                        A semi-permanent tint that enhances your natural lip color and shape for a soft, "just-bitten" flush.
                    </p>
                </div>

                <div class="mt-auto">
                    <h3 class="uppercase text-[11px] font-bold tracking-[0.3em] text-zinc-500 mb-6 flex items-center gap-4">
                        Select Service <span class="flex-grow h-[1px] bg-zinc-800"></span>
                    </h3>
                    
                    <div class="grid grid-cols-4 md:grid-cols-6 gap-3 mb-10">
                        @php
                        $misc_services = [
                            ['lips.png', 'LIP BLUSH', '1 Session: ₱1,299.00<br>2 Sessions: ₱2,399.00', 'A semi-permanent tint that enhances your natural lip color and shape for a soft, "just-bitten" flush.'],
                            ['wartspng.png', 'WARTS REMOVAL', '1 Session: ₱199.00<br>2 Sessions: ₱349.00', 'A quick and safe procedure to effectively eliminate skin warts for a clearer, smoother complexion.']
                        ];
                        @endphp

                        @foreach($misc_services as $index => $item)
                        <button onclick="updateMiscDisplay('{{ $item[0] }}', '{{ addslashes($item[1]) }}', '{{ addslashes($item[2]) }}', '{{ addslashes($item[3]) }}')" 
                                class="misc-thumb-btn relative aspect-square border-2 {{ $index === 0 ? 'border-red-600' : 'border-transparent' }} rounded overflow-hidden transition-all duration-300 hover:scale-110 hover:z-20">
                            <img src="{{ asset('images/' . $item[0]) }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all">
                        </button>
                        @endforeach
                    </div>

                    <a href="/login" class="relative overflow-hidden group inline-block bg-red-600 text-white font-black py-5 px-14 uppercase tracking-[0.2em] transition-all duration-300">
                        <span class="relative z-10 group-hover:text-black transition-colors duration-300">Book Now</span>
                        <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function updateMiscDisplay(imgName, title, pricing, desc) {
        const imgSlider = document.getElementById('misc-image-slider');
        const textSlider = document.getElementById('misc-text-slider');
        
        // Swipe Out
        imgSlider.style.transform = 'translateX(-115%)';
        imgSlider.style.opacity = '0';
        textSlider.style.transform = 'translateX(-40px)';
        textSlider.style.opacity = '0';
        
        setTimeout(() => {
            imgSlider.style.transition = 'none';
            imgSlider.style.transform = 'translateX(115%)';
            textSlider.style.transition = 'none';
            textSlider.style.transform = 'translateX(40px)';

            // Update Content
            document.getElementById('misc-display-image').src = `{{ asset('images/') }}/${imgName}`;
            document.getElementById('misc-display-title').innerText = title;
            document.getElementById('misc-display-pricing').innerHTML = pricing.split('<br>').map((p, i) => 
                `<p class="${i === 0 ? 'text-2xl text-white' : 'text-xl text-zinc-400'} font-black tracking-widest uppercase">${p}</p>`
            ).join('');
            document.getElementById('misc-display-desc').innerText = desc;

            // Swipe In
            setTimeout(() => {
                imgSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                imgSlider.style.transform = 'translateX(0)';
                imgSlider.style.opacity = '1';
                
                textSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                textSlider.style.transform = 'translateX(0)';
                textSlider.style.opacity = '1';
            }, 50);
        }, 350);

        // Update Thumbnails
        document.querySelectorAll('.misc-thumb-btn').forEach(btn => {
            btn.classList.remove('border-red-600');
            btn.classList.add('border-transparent');
        });
        event.currentTarget.classList.add('border-red-600');
    }
</script>
    <main class="bg-[#0b0b0b] min-h-screen text-white font-sans py-12 px-4 md:px-10 overflow-x-hidden">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col items-center justify-center text-center w-full mb-20 animate-slide-in">
            <h2 class="text-6xl md:text-6xl font-black uppercase tracking-tighter leading-none italic">
                Meso<br><span class="text-red-600">Liposuction</span>
            </h2>
            <div class="w-32 h-1.5 bg-red-600 mt-8 shadow-[0_0_20px_rgba(220,38,38,0.4)]"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start bg-black p-8 rounded-xl border border-zinc-800 mb-20 shadow-[0_20px_60px_rgba(0,0,0,1)] relative overflow-hidden">
            
            <div class="lg:col-span-5 relative overflow-hidden rounded-2xl bg-zinc-900 border border-white/10 group">
                <div id="meso-image-slider" class="relative w-full aspect-[4/5] transition-all duration-500 ease-in-out">
                    <img src="{{ asset('images/meso1.png') }}" id="meso-display-image" 
                         class="w-full h-full object-cover rounded-xl" 
                         alt="Meso Lipo Service">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-600/10 to-transparent pointer-events-none"></div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col h-full py-2">
                <div id="meso-text-slider" class="transition-all duration-500 ease-in-out">
                    <h3 id="meso-display-title" class="text-4xl font-black uppercase italic tracking-tighter mb-2 text-red-600">MESO LIPO FACE (FREE RF)</h3>
                    <div id="meso-display-pricing" class="mb-6 space-y-1">
                        <p class="text-2xl font-black text-white tracking-widest uppercase">1 Session: ₱429.00</p>
                        <p class="text-xl font-bold text-zinc-400 tracking-widest uppercase">5 Sessions: ₱1,930.00</p>
                        <p class="text-xl font-bold text-zinc-400 tracking-widest uppercase">12 Sessions: ₱4,536.00</p>
                    </div>
                    
                    <p id="meso-display-desc" class="text-zinc-400 italic text-lg mb-10 min-h-[120px] leading-relaxed border-l-4 border-red-600 pl-6 uppercase">
                        A non-surgical fat-melting injection that slims the face and jawline, paired with RF to tighten the skin.
                    </p>
                </div>

                <div class="mt-auto">
                    <h3 class="uppercase text-[11px] font-bold tracking-[0.3em] text-zinc-500 mb-6 flex items-center gap-4">
                        Select Target Area <span class="flex-grow h-[1px] bg-zinc-800"></span>
                    </h3>
                    
                    <div class="grid grid-cols-4 md:grid-cols-6 gap-3 mb-10">
                        @php
                        $meso_services = [
                            ['meso1.png', 'MESO LIPO FACE (FREE RF)', '1 Session: ₱429.00<br>5 Sessions: ₱1,930.00<br>12 Sessions: ₱4,536.00', 'A non-surgical fat-melting injection that slims the face and jawline, paired with RF to tighten the skin.'],
                            ['meso2.png', 'MESO LIPO ARMS (FREE RF)', '1 Session: ₱629.00<br>5 Sessions: ₱2,830.00<br>12 Sessions: ₱6,042.00', 'Targets stubborn arm fat with localized injections and RF to eliminate flab and sculpt a leaner look.'],
                            ['meso3.png', 'MESO LIPO TUMMY (FREE RF)', '1 Session: ₱729.00<br>5 Sessions: ₱3,235.00<br>12 Sessions: ₱7,582.00', 'A powerful treatment to dissolve abdominal fat and tighten the stomach area for a flatter silhouette.'],
                            ['meso4.png', 'MESO LIPO LEGS (FREE RF)', '1 Session: ₱729.00<br>5 Sessions: ₱3,235.00<br>12 Sessions: ₱7,582.00', 'Specifically designed to melt fat in the thighs and calves while smoothing skin texture with RF.']
                        ];
                        @endphp

                        @foreach($meso_services as $index => $item)
                        <button onclick="updateMesoDisplay('{{ $item[0] }}', '{{ addslashes($item[1]) }}', '{{ addslashes($item[2]) }}', '{{ addslashes($item[3]) }}')" 
                                class="meso-thumb-btn relative aspect-square border-2 {{ $index === 0 ? 'border-red-600' : 'border-transparent' }} rounded overflow-hidden transition-all duration-300 hover:scale-110 hover:z-20">
                            <img src="{{ asset('images/' . $item[0]) }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all">
                        </button>
                        @endforeach
                    </div>

                    <a href="/login" class="relative overflow-hidden group inline-block bg-red-600 text-white font-black py-5 px-14 uppercase tracking-[0.2em] transition-all duration-300">
                        <span class="relative z-10 group-hover:text-black transition-colors duration-300">Book Session</span>
                        <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function updateMesoDisplay(imgName, title, pricing, desc) {
        const imgSlider = document.getElementById('meso-image-slider');
        const textSlider = document.getElementById('meso-text-slider');
        
        // Swipe Out
        imgSlider.style.transform = 'translateX(-115%)';
        imgSlider.style.opacity = '0';
        textSlider.style.transform = 'translateX(-40px)';
        textSlider.style.opacity = '0';
        
        setTimeout(() => {
            imgSlider.style.transition = 'none';
            imgSlider.style.transform = 'translateX(115%)';
            textSlider.style.transition = 'none';
            textSlider.style.transform = 'translateX(40px)';

            // Update Content
            document.getElementById('meso-display-image').src = `{{ asset('images/') }}/${imgName}`;
            document.getElementById('meso-display-title').innerText = title;
            document.getElementById('meso-display-pricing').innerHTML = pricing.split('<br>').map((p, i) => 
                `<p class="${i === 0 ? 'text-2xl text-white' : 'text-xl text-zinc-400'} font-black tracking-widest uppercase">${p}</p>`
            ).join('');
            document.getElementById('meso-display-desc').innerText = desc;

            // Swipe In
            setTimeout(() => {
                imgSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                imgSlider.style.transform = 'translateX(0)';
                imgSlider.style.opacity = '1';
                
                textSlider.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                textSlider.style.transform = 'translateX(0)';
                textSlider.style.opacity = '1';
            }, 50);
        }, 350);

        // Active Thumbnail UI
        document.querySelectorAll('.meso-thumb-btn').forEach(btn => {
            btn.classList.remove('border-red-600');
            btn.classList.add('border-transparent');
        });
        event.currentTarget.classList.add('border-red-600');
    }
</script>
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