<x-guest-layout>
    <style>
        #login-brand {
            background: #000 linear-gradient(180deg, #110000 0%, #000 100%);
        }
        #login-brand::after {
            content: "";
            position: absolute;
            inset: 0;
            background: url("{{ asset('images/atonet.jpg') }}") center center/cover no-repeat;
            opacity: 0.55;
            z-index: 0;
        }
        #login-brand::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0.55) 0%, rgba(17,0,0,0.65) 55%, rgba(0,0,0,0.95) 100%);
            z-index: 1;
        }
        #login-panel {
            background: #050505 radial-gradient(1200px circle at 80% -10%, rgba(220,38,38,0.12), transparent 45%);
        }
        .field-input {
            width: 100%;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.10);
            color: #fff;
            font-size: 0.875rem;
            padding: 0.9rem 1rem 0.9rem 2.75rem;
            border-radius: 0.75rem;
            transition: all 0.25s ease;
        }
        .field-input::placeholder { color: #4b5563; }
        .field-input:focus {
            outline: none;
            border-color: rgba(220,38,38,0.7);
            background: rgba(255,255,255,0.05);
            box-shadow: 0 0 0 4px rgba(220,38,38,0.12);
        }
    </style>

    <div class="min-h-screen flex font-sans bg-black text-white">

        <!-- ===== Left: Brand / Imagery ===== -->
        <div id="login-brand" class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col justify-between p-14">
            <a href="{{ route('home') }}" class="relative z-10 flex items-center gap-3 group w-fit">
                <img src="{{ asset('images/woman-with-long-hair.png') }}" class="w-8 h-8" style="filter: brightness(0) invert(1);">
                <span class="font-black text-lg italic tracking-tighter">TONET SALON</span>
            </a>

            <div class="relative z-10 max-w-md">
                <span class="text-red-500 font-black text-[11px] uppercase tracking-[0.4em]">Members Area</span>
                <h2 class="mt-5 text-5xl font-black uppercase leading-[0.95] italic">
                    Unveil<br>Your <span class="text-red-600">Shine</span>
                </h2>
                <p class="mt-6 text-gray-300 text-sm leading-relaxed">
                    Sign in to manage your appointments, track your visits, and experience the gold standard of hair care at Tonet Salon.
                </p>
                <div class="mt-10 flex items-center gap-8 border-t border-white/10 pt-6">
                    <div>
                        <p class="text-2xl font-black text-red-600">5+</p>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-bold">Years of Trust</p>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-red-600">2020</p>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-bold">Established</p>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-red-600">Danao</p>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-bold">Cebu</p>
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-gray-500 text-[10px] uppercase tracking-[0.4em] font-black">&copy; 2026 Tonet Salon MS</p>
        </div>

        <!-- ===== Right: Form ===== -->
        <div id="login-panel" class="w-full lg:w-1/2 flex flex-col items-center justify-center px-6 py-12 relative">

            <a href="{{ route('home') }}" class="absolute top-8 right-8 flex items-center gap-2 text-gray-500 hover:text-red-500 transition-colors group text-[10px] uppercase tracking-[0.3em] font-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Home
            </a>

            <div class="w-full max-w-sm">
                <!-- Mobile brand -->
                <div class="lg:hidden mb-10 text-center">
                    <h1 class="text-4xl font-black uppercase tracking-tighter italic">TONET <span class="text-red-600">SALON</span></h1>
                </div>

                <div class="mb-9">
                    <h1 class="text-3xl font-black uppercase tracking-tight">Welcome Back</h1>
                    <p class="mt-2 text-sm text-gray-500">Enter your credentials to access your account.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Email Address</label>
                        <div class="relative">
                            <svg class="w-4 h-4 text-gray-600 absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                class="field-input" placeholder="name@example.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold uppercase" />
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Password</label>
                        <div class="relative">
                            <svg class="w-4 h-4 text-gray-600 absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <input type="password" name="password" required autocomplete="current-password"
                                class="field-input" placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-bold uppercase" />
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center text-[11px] font-bold text-gray-400 cursor-pointer hover:text-gray-200 transition-colors">
                            <input type="checkbox" name="remember" class="w-4 h-4 bg-black/50 border-white/20 text-red-600 focus:ring-0 focus:ring-offset-0 mr-2 rounded">
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-gray-500 hover:text-red-500 transition-colors">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-500 text-white font-black uppercase tracking-[0.2em] py-4 rounded-xl text-xs transition-all duration-300 shadow-[0_10px_30px_-8px_rgba(220,38,38,0.6)] hover:shadow-[0_16px_40px_-8px_rgba(220,38,38,0.8)] hover:-translate-y-0.5 active:translate-y-0">
                        Sign In
                    </button>
                </form>

                <div class="mt-8 flex items-center gap-4">
                    <span class="h-px flex-1 bg-white/10"></span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-gray-600 font-bold">New here?</span>
                    <span class="h-px flex-1 bg-white/10"></span>
                </div>

                <a href="{{ route('register') }}" class="mt-6 block w-full text-center border border-white/15 hover:border-red-600 hover:text-red-500 text-gray-300 font-black uppercase tracking-[0.2em] py-4 rounded-xl text-xs transition-all duration-300">
                    Create an Account
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
