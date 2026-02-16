<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tonet Salon Management System</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .bg-dark-home { background-color: #121212; }
        .bg-card-dark { background-color: #1e1e1e; }
        .border-dark-red { border-color: #3d0a0a; }
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 10px; }
        input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); }

        /* HOVER TRANSITION FOR SESSIONS */
        .session-info {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.4s ease-in-out;
        }
        /* When hovering the price container, reveal the session info */
        .price-container:hover .session-info {
            max-height: 100px; /* Adjust if list is very long */
            opacity: 1;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body class="font-sans antialiased bg-dark-home text-gray-200" x-data="{ 
    appointments: [],
    showModal: false,
    step: 1,
    selectedService: '',
    selectedPrice: '',
    selectedDuration: '',
    
    services: [
        // HAIR COLOR & REBOND
        { category: 'HAIR COLOR & REBOND', name: 'REBOND BRAZILLIAN BOTOX', price: '₱2,000.00', duration: '3-4 hrs', img: '{{ asset('images/rebond1.jpg') }}', desc: 'ALL-IN-ONE TREATMENT PERMANENTLY STRAIGHTENS AND REPAIRS.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'REBOND BOTOX COLOR', price: '₱2,500.00', duration: '4-5 hrs', img: '{{ asset('images/rebond2.jpg') }}', desc: 'STRAIGHTENS, REPAIRS, AND ADDS VIBRANT COLOR.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'COLOR (SHORT)', price: '₱500.00', duration: '1.5 hrs', img: '{{ asset('images/rebond3.jpg') }}', desc: 'PROFESSIONAL COLORING FOR SHORTER LENGTHS.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'COLOR (LONG)', price: '₱800.00', duration: '2 hrs', img: '{{ asset('images/rebond4.jpg') }}', desc: 'EVEN COVERAGE AND VIBRANT SHADE FOR LONG HAIR.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'COLOR BOTOX (SHORT)', price: '₱1,100.00', duration: '2 hrs', img: '{{ asset('images/rebond5.jpg') }}', desc: 'RAPID CUTICLE REPAIR AND TONE REFRESHMENT.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'COLOR BOTOX (LONG)', price: '₱1,600.00', duration: '2.5 hrs', img: '{{ asset('images/rebond6.jpg') }}', desc: 'INTENSIVE RESTORATION FOR HAIR BELOW SHOULDERS.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'HIGHLIGHTS (SHORT)', price: '₱500.00', duration: '2 hrs', img: '{{ asset('images/rebond7.png') }}', desc: 'ADDS SUN-KISSED DIMENSION AND SILKY SHINE.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'HIGHLIGHTS (LONG)', price: '₱800.00', duration: '3 hrs', img: '{{ asset('images/rebond8.png') }}', desc: 'MULTI-DIMENSIONAL COLOR WITH DEEP-REPAIR.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'HIGHLIGHTS COLOR BOTOX', price: '₱2,000.00', duration: '3.5 hrs', img: '{{ asset('images/rebond9.png') }}', desc: 'NEUTRALIZES BRASSINESS AND ADDS HIGH-GLOSS SHINE.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'BALAYAGE BOTOX', price: '₱3,000.00', duration: '4 hrs', img: '{{ asset('images/rebond10.png') }}', desc: 'ENHANCES HAND-PAINTED GRADIENTS WITH HYDRATION.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'BALAYAGE REBOND BOTOX', price: '₱4,500.00', duration: '5-6 hrs', img: '{{ asset('images/rebond11.png') }}', desc: 'STRAIGHTENS WHILE REPAIRING HAND-PAINTED TONES.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'CELLOPHANE TREATMENT', price: '₱500.00', duration: '1 hr', img: '{{ asset('images/rebond12.png') }}', desc: 'CHEMICAL-FREE SEMI-PERMANENT GLOSS AND SHINE.', sessions: null },
        { category: 'HAIR COLOR & REBOND', name: 'BRAZILLIAN BOTOX TREATMENT', price: '₱800.00', duration: '1.5 hrs', img: '{{ asset('images/rebond13.png') }}', desc: 'ELIMINATES FRIZZ AND REPAIRS HAIR FIBERS.', sessions: null },

        // RF SLIMMING & CONTOUR (WITH SESSIONS)
        { category: 'RF SLIMMING & CONTOUR', name: 'RF FACE', price: '₱229.00', duration: '30 mins', img: '{{ asset('images/rf1.png') }}', desc: 'NON-INVASIVE SKIN TIGHTENING AND FACIAL CONTOURING.', sessions: null },
        { category: 'RF SLIMMING & CONTOUR', name: 'RF ARMS W/ CAVITATION', price: '₱429.00', duration: '45 mins', img: '{{ asset('images/rf2.png') }}', desc: 'FIRM LOOSE SKIN AND SCULPT UPPER ARMS.', sessions: ['5 SESSIONS: ₱1,930.00', '12 SESSIONS: ₱4,350.00'] },
        { category: 'RF SLIMMING & CONTOUR', name: 'RF TUMMY W/ CAVITATION', price: '₱519.00', duration: '45 mins', img: '{{ asset('images/rf3.png') }}', desc: 'FIRMS ABDOMINAL AREA FOR A TIGHTER WAISTLINE.', sessions: ['5 SESSIONS: ₱2,335.00', '12 SESSIONS: ₱5,480.00'] },
        { category: 'RF SLIMMING & CONTOUR', name: 'RF LEGS W/ CAVITATION', price: '₱519.00', duration: '45 mins', img: '{{ asset('images/rf4.png') }}', desc: 'REDUCE CELLULITE AND CONTOUR THE LEGS.', sessions: ['5 SESSIONS: ₱2,335.00', '12 SESSIONS: ₱5,480.00'] },

        // EYEBROWS (WITH SESSIONS)
        { category: 'EYEBROWS', name: 'MICRO SHADING', price: '₱1,299.00', duration: '2 hrs', img: '{{ asset('images/eyebrows1.png') }}', desc: 'SOFT, POWDERED MAKEUP LOOK FOR SPARSE BROWS.', sessions: ['2 SESSIONS: ₱2,399.00'] },
        { category: 'EYEBROWS', name: 'MICRO BLADING/OMBRE', price: '₱1,299.00', duration: '2.5 hrs', img: '{{ asset('images/eyebrows2.png') }}', desc: 'FINE STROKES FOR NATURAL-LOOKING HAIR GRADIENTS.', sessions: ['2 SESSIONS: ₱2,399.00'] },
        { category: 'EYEBROWS', name: 'COMBO BROW', price: '₱2,099.00', duration: '3 hrs', img: '{{ asset('images/eyebrows3.png') }}', desc: 'HYBRID OF BLADING AND SHADING FOR MAXIMUM DIMENSION.', sessions: ['2 SESSIONS: ₱3,999.00'] },
        { category: 'EYEBROWS', name: 'BROWS LAMINATION', price: '₱349.00', duration: '1 hr', img: '{{ asset('images/eyebrows4.png') }}', desc: 'REALIGNS HAIR FOR FULLER, FLUFFIER GROOMED BROWS.', sessions: null },
        { category: 'EYEBROWS', name: 'EYEBROW THREADING', price: '₱50.00', duration: '15 mins', img: '{{ asset('images/eyebrows5.png') }}', desc: 'PRECISE HAIR REMOVAL FOR A SHARP BROW ARCH.', sessions: null },

        // MESO LIPOSUCTION (WITH SESSIONS)
        { category: 'MESO LIPOSUCTION', name: 'MESO LIPO FACE (FREE RF)', price: '₱429.00', duration: '45 mins', img: '{{ asset('images/meso1.png') }}', desc: 'NON-SURGICAL FAT-MELTING INJECTION FOR JAWLINE.', sessions: ['5 SESSIONS: ₱1,930.00', '12 SESSIONS: ₱4,536.00'] },
        { category: 'MESO LIPOSUCTION', name: 'MESO LIPO ARMS (FREE RF)', price: '₱629.00', duration: '1 hr', img: '{{ asset('images/meso2.png') }}', desc: 'TARGETS STUBBORN ARM FAT AND ELIMINATES FLAB.', sessions: ['5 SESSIONS: ₱2,830.00', '12 SESSIONS: ₱6,042.00'] },
        { category: 'MESO LIPOSUCTION', name: 'MESO LIPO TUMMY (FREE RF)', price: '₱729.00', duration: '1 hr', img: '{{ asset('images/meso3.png') }}', desc: 'DISSOLVES ABDOMINAL FAT FOR A FLATTER SILHOUETTE.', sessions: ['5 SESSIONS: ₱3,235.00', '12 SESSIONS: ₱7,582.00'] },
        { category: 'MESO LIPOSUCTION', name: 'MESO LIPO LEGS (FREE RF)', price: '₱729.00', duration: '1 hr', img: '{{ asset('images/meso4.png') }}', desc: 'MELT FAT IN THIGHS AND CALVES WHILE SMOOTHING TEXTURE.', sessions: ['5 SESSIONS: ₱3,235.00', '12 SESSIONS: ₱7,582.00'] },

        // OTHERS
        { category: 'OTHERS', name: 'LIP BLUSH', price: '₱1,299.00', duration: '2 hrs', img: '{{ asset('images/lips.png') }}', desc: 'SEMI-PERMANENT TINT ENHANCEMENT.', sessions: ['2 SESSIONS: ₱2,399.00'] },
        { category: 'OTHERS', name: 'WARTS REMOVAL', price: '₱199.00', duration: '30-60 mins', img: '{{ asset('images/wartspng.png') }}', desc: 'QUICK AND SAFE ELIMINATION.', sessions: ['2 SESSIONS: ₱349.00'] },

        // NAILS & SPA
        { category: 'NAILS & SPA', name: 'PEDICURE/MANICURE', price: '₱100.00', duration: '1 hr', img: '{{ asset('images/manicure1.png') }}', desc: 'GROOMING THE NAILS AND THE SKIN IMMEDIATELY SURROUNDING THEM.', sessions: null },
        { category: 'NAILS & SPA', name: 'FOOT SPA', price: '₱300.00', duration: '1.5 hrs', img: '{{ asset('images/footspa.png') }}', desc: 'INTENSIVE TREATMENT FOR THE ENTIRE FOOT UP TO THE ANKLE OR CALF.', sessions: null }
    ],
    selectService(name, price, duration) {
        this.selectedService = name;
        this.selectedPrice = price;
        this.selectedDuration = duration;
        this.step = 2;
    }
}">
    <div class="min-h-screen">
        <nav class="bg-black border-b border-red-900 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-14">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-red-600 text-2xl font-bold">✂</span>
                            <span class="text-lg font-bold tracking-tight uppercase">Tonet Salon Management System</span>
                        </div>
                        <div class="hidden md:flex space-x-2 ml-10 text-xs font-bold uppercase tracking-widest">
                            <a href="{{ route('client_main') }}" class="text-red-500 bg-red-950 bg-opacity-30 px-3 py-2 rounded flex items-center border border-red-900">Dashboard</a>
                            <a href="#" @click="showModal = true; step = 1" class="hover:text-red-500 px-3 py-2 transition flex items-center">Book Appointment</a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition flex items-center">My Appointments</a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition flex items-center">Invoices</a>
                            <a href="#" class="hover:text-red-500 px-3 py-2 transition flex items-center">Services</a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center text-xs font-bold uppercase hover:text-red-500 transition">
                                👤 {{ Auth::user()->name }}
                                <svg class="ms-1 fill-current h-4 w-4 text-red-600" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg>
                            </button>
                            <div x-show="dropdownOpen" class="absolute right-0 z-50 mt-2 w-48 rounded shadow-xl bg-card-dark border border-red-900 py-1 text-gray-300" style="display: none;">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-red-900 hover:text-white">Profile Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-900 hover:text-white font-bold" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-black text-white uppercase italic">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-red-500 font-medium tracking-wide">Manage your appointments and beauty treatments.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-card-dark p-6 rounded border border-red-900 flex justify-between items-center shadow-2xl">
                    <div><p class="text-5xl font-black text-white" x-text="appointments.length">0</p><p class="text-gray-400 text-xs font-bold uppercase mt-1">Total Appointments</p></div>
                    <div class="text-red-600 text-3xl">📅</div>
                </div>
                <div class="bg-card-dark p-6 rounded border border-red-900 flex justify-between items-center shadow-2xl">
                    <div><p class="text-5xl font-black text-white">0</p><p class="text-gray-400 text-xs font-bold uppercase mt-1">Upcoming Appointments</p></div>
                    <div class="text-yellow-500 text-3xl">🕒</div>
                </div>
                <div class="bg-card-dark p-6 rounded border border-red-900 flex justify-between items-center shadow-2xl">
                    <div><p class="text-5xl font-black text-white">₱0.00</p><p class="text-gray-400 text-xs font-bold uppercase mt-1">Total Spent</p></div>
                    <div class="text-blue-500 text-3xl">💰</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-card-dark p-12 rounded border border-red-900 flex flex-col items-center justify-center text-center shadow-2xl">
                        <div class="w-20 h-20 rounded-full mb-6 flex items-center justify-center text-red-600 text-4xl font-bold border-2 border-dashed border-red-900 bg-red-950 bg-opacity-20">+</div>
                        <h3 class="text-2xl font-black text-white uppercase italic">No Upcoming Appointments</h3>
                        <p class="text-gray-400 mb-8 max-w-xs">Book your next magic treatment today!</p>
                        <button @click="showModal = true; step = 1" class="bg-red-600 text-white px-8 py-3 rounded font-black uppercase tracking-tighter hover:bg-red-700 transition shadow-lg transform hover:scale-105">Book Appointment</button>
                    </div>

                    <div class="bg-card-dark rounded border border-red-900 overflow-hidden shadow-2xl">
                        <div class="px-6 py-4 border-b border-red-900 flex justify-between items-center bg-black bg-opacity-40">
                            <h3 class="font-bold text-white uppercase text-sm tracking-widest flex items-center"><span class="mr-2 text-red-600">🕒</span> Recent Appointments</h3>
                            <a href="#" class="text-red-500 text-xs uppercase hover:underline font-bold">View All</a>
                        </div>
                        <div class="p-16 text-center text-gray-500">
                            <p class="uppercase text-xs tracking-widest">No appointments found.</p>
                            <button @click="showModal = true; step = 1" class="mt-4 text-red-500 font-bold border border-red-900 px-4 py-1 rounded hover:bg-red-900 hover:text-white transition">Book Your First</button>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-card-dark rounded border border-red-900 p-6 shadow-2xl">
                        <h3 class="font-bold text-white uppercase text-sm tracking-widest mb-6 flex items-center"><span class="mr-2 text-red-600">⚡</span> Quick Actions</h3>
                        <div class="space-y-4">
                            <button @click="showModal = true; step = 1" class="w-full bg-red-600 text-white py-3 rounded font-black uppercase tracking-tighter hover:bg-red-700 transition">Book New Appointment</button>
                            <div class="flex flex-col space-y-4 pt-4">
                                <a href="#" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center"><span class="mr-2 text-red-600">📋</span> View All Appointments</a>
                                <a href="#" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center"><span class="mr-2 text-red-600">📄</span> View Invoices</a>
                                <a href="#" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center"><span class="mr-2 text-red-600">🌿</span> Browse Services</a>
                                <a href="{{ route('profile.edit') }}" class="text-gray-400 text-sm hover:text-red-500 font-bold uppercase tracking-tight flex items-center"><span class="mr-2 text-red-600">👤</span> Update Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-90" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         style="display: none;">
        
        <div class="bg-card-dark w-full max-w-6xl rounded border border-red-900 shadow-2xl overflow-hidden flex flex-col max-h-[92vh]">
            
            <div class="bg-black border-b border-red-900 p-5 flex justify-between items-center shadow-xl">
                <div class="flex items-center space-x-3">
                    <span class="text-red-600 text-2xl font-bold">✂</span>
                    <h2 class="text-white font-black uppercase italic tracking-tighter text-xl">
                        <span x-text="step === 1 ? 'Select Service' : 'Schedule Visit'"></span>
                    </h2>
                </div>
                <button @click="showModal = false; step = 1" class="text-gray-500 hover:text-red-600 text-3xl font-black transition leading-none">&times;</button>
            </div>

            <div class="p-8 overflow-y-auto custom-scroll bg-dark-home">
                
                <div x-show="step === 1" x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <template x-for="(service, index) in services" :key="index">
                            <div class="contents">
                                <template x-if="index === 0 || service.category !== services[index-1].category">
                                    <div class="col-span-full mt-12 mb-8 text-center">
                                        <h2 class="text-red-600 font-black uppercase text-4xl italic tracking-tighter inline-block border-b-4 border-red-600 pb-2" x-text="service.category"></h2>
                                    </div>
                                </template>

                                <div class="bg-card-dark border border-red-900 p-4 rounded group hover:border-red-600 transition-all flex flex-col shadow-lg">
                                    <div class="relative">
                                        <img :src="service.img" class="w-full h-40 object-cover rounded mb-4 opacity-70 group-hover:opacity-100 transition border border-red-900">
                                        <span class="absolute top-2 right-2 bg-black bg-opacity-80 text-white text-[9px] font-black px-2 py-1 rounded border border-red-900 uppercase tracking-widest" x-text="'🕒 ' + service.duration"></span>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <h4 class="font-black text-white text-sm uppercase mb-1 tracking-tight" x-text="service.name"></h4>
                                        <p class="text-gray-500 text-[10px] uppercase mb-4 font-bold leading-tight" x-text="service.desc"></p>
                                    </div>

                                    <div class="flex justify-between items-end pt-3 border-t border-red-900/50">
                                        <div class="price-container cursor-help flex-1">
                                            <span class="text-[9px] text-gray-500 uppercase block font-bold">Starts At:</span>
                                            <span class="text-red-600 font-black text-lg leading-none" x-text="service.price"></span>
                                            
                                            <div class="session-info mt-1" x-show="service.sessions">
                                                <template x-for="session in service.sessions">
                                                    <p class="text-white text-[9px] font-bold uppercase tracking-tight" x-text="session"></p>
                                                </template>
                                            </div>
                                        </div>

                                        <button @click="selectService(service.name, service.price, service.duration)" 
                                                class="bg-red-600 text-white text-[10px] font-black px-4 py-2 uppercase tracking-widest hover:bg-white hover:text-black transition-colors shadow-lg">
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="step === 2" x-transition class="max-w-md mx-auto py-4">
                    <button @click="step = 1" class="text-red-600 font-black text-[10px] uppercase mb-6 flex items-center hover:text-white transition group">
                        <span class="mr-2 group-hover:-translate-x-1 transition-transform">←</span> Back to Services
                    </button>
                    
                    <div class="bg-card-dark border border-red-900 p-8 rounded shadow-2xl space-y-6">
                        <div class="border-b border-red-900 pb-4">
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1">Service Selected</p>
                            <h3 class="text-xl font-black text-white uppercase italic tracking-tighter" x-text="selectedService"></h3>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-red-600 font-black text-lg" x-text="selectedPrice"></p>
                                <p class="text-gray-400 font-bold text-xs uppercase tracking-widest" x-text="'Duration: ' + selectedDuration"></p>
                            </div>
                        </div>

                        <form class="space-y-5">
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Select Date</label>
                                <input type="date" class="w-full bg-black border border-red-900 rounded p-3 text-white text-sm focus:border-red-600 focus:ring-0 outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-2 tracking-widest">Select Time</label>
                                <select class="w-full bg-black border border-red-900 rounded p-3 text-white text-sm focus:border-red-600 focus:ring-0 outline-none">
                                    <option class="bg-card-dark">09:00 AM</option>
                                    <option class="bg-card-dark">10:30 AM</option>
                                    <option class="bg-card-dark">01:00 PM</option>
                                    <option class="bg-card-dark">03:30 PM</option>
                                    <option class="bg-card-dark">05:00 PM</option>
                                </select>
                            </div>

                            <button type="button" @click="alert('Booking Request Sent for ' + selectedService + '!'); showModal = false; step = 1" 
                                    class="w-full bg-red-600 text-white py-4 rounded font-black uppercase tracking-widest shadow-lg hover:bg-white hover:text-black transition-all transform hover:scale-[1.02]">
                                Confirm Appointment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="p-4 bg-black border-t border-red-900 flex justify-end">
                <button @click="showModal = false; step = 1" class="text-[10px] font-black uppercase text-gray-500 hover:text-red-600 transition tracking-widest">
                    Exit Booking
                </button>
            </div>
        </div>
    </div>
</body>
</html>