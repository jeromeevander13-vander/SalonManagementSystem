<x-guest-layout>
    <div id="login-container" class="min-h-screen bg-black flex flex-col items-center justify-center p-6 relative overflow-hidden font-sans">
        <!-- Interactive Cursor Glow -->
        <div id="cursor-glow" class="absolute inset-0 pointer-events-none z-0 transition-opacity duration-300 opacity-0" 
             style="background: radial-gradient(600px circle at var(--x, 0px) var(--y, 0px), rgba(220, 38, 38, 0.15), transparent 80%);"></div>

        <!-- Animated Background Glows -->
        <div class="absolute top-1/4 -left-20 w-80 h-80 bg-red-600/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-red-900/10 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s"></div>

        <script>
            const container = document.getElementById('login-container');
            const glow = document.getElementById('cursor-glow');
            
            container.addEventListener('mousemove', (e) => {
                const rect = container.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                glow.style.setProperty('--x', `${x}px`);
                glow.style.setProperty('--y', `${y}px`);
                glow.style.opacity = '1';
            });

            container.addEventListener('mouseleave', () => {
                glow.style.opacity = '0';
            });
        </script>

        <div class="relative z-10 w-full max-w-md transform transition-all duration-500 hover:scale-[1.01]">
            <div class="mb-10 text-center">
                <h1 class="text-6xl font-black uppercase tracking-tighter text-white leading-none italic drop-shadow-2xl">
                    TONET <span class="text-red-600">SALON</span>
                </h1>
                <div class="flex items-center justify-center gap-4 mt-4">
                    <span class="h-[1px] w-12 bg-red-600/50"></span>
                    <p class="text-[10px] text-gray-400 uppercase tracking-[0.4em] font-bold">Unveil Your Shine</p>
                    <span class="h-[1px] w-12 bg-red-600/50"></span>
                </div>
            </div>

            <!-- Glass Container -->
            <div class="backdrop-blur-xl bg-white/5 border border-white/10 p-10 shadow-[0_25px_50px_-12px_rgba(220,38,38,0.2)] rounded-2xl relative overflow-hidden group">
                <!-- 3D Edge Effect -->
                <div class="absolute inset-x-0 top-0 h-[1px] bg-gradient-to-r from-transparent via-red-600/50 to-transparent"></div>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="group/input">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2 group-focus-within/input:text-red-500 transition-colors">Email Address</label>
                        <div class="relative">
                            <input type="email" name="email" :value="old('email')" required autofocus 
                                class="w-full bg-black/40 border-white/10 text-white focus:border-red-600 focus:ring-0 text-sm py-4 px-5 rounded-xl transition-all placeholder:text-gray-700 backdrop-blur-md"
                                placeholder="name@example.com">
                            <div class="absolute bottom-0 left-0 h-[2px] w-0 bg-red-600 group-focus-within/input:w-full transition-all duration-300 rounded-full"></div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold uppercase" />
                    </div>

                    <div class="group/input">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2 group-focus-within/input:text-red-500 transition-colors">Password</label>
                        <div class="relative">
                            <input type="password" name="password" required 
                                class="w-full bg-black/40 border-white/10 text-white focus:border-red-600 focus:ring-0 text-sm py-4 px-5 rounded-xl transition-all placeholder:text-gray-700 backdrop-blur-md"
                                placeholder="••••••••">
                            <div class="absolute bottom-0 left-0 h-[2px] w-0 bg-red-600 group-focus-within/input:w-full transition-all duration-300 rounded-full"></div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-bold uppercase" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center text-[10px] uppercase font-black text-gray-500 cursor-pointer hover:text-gray-300 transition-colors">
                            <input type="checkbox" name="remember" class="bg-black/50 border-white/10 text-red-600 focus:ring-0 focus:ring-offset-0 mr-3 rounded-sm"> 
                            Remember Me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] uppercase font-black text-gray-600 hover:text-red-600 transition-all">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-red-700 hover:bg-red-600 text-white font-black uppercase tracking-[0.2em] py-5 rounded-xl text-xs transition-all duration-500 shadow-[0_10px_30px_-5px_rgba(185,28,28,0.5)] hover:shadow-[0_15px_40px_-5px_rgba(185,28,28,0.7)] hover:-translate-y-1 active:translate-y-0">
                        Access Account
                    </button>
                </form>

                <div class="mt-10 text-center border-t border-white/5 pt-8">
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-500">
                        First time here? 
                        <a href="{{ route('register') }}" class="text-red-600 hover:text-white transition-all ml-2 underline decoration-red-600/30 underline-offset-4">Create Account</a>
                    </p>
                </div>
            </div>

            <p class="mt-12 text-center text-gray-800 text-[10px] uppercase tracking-[0.5em] font-black">&copy; 2026 TONET SALON MS</p>
        </div>
    </div>
</x-guest-layout>