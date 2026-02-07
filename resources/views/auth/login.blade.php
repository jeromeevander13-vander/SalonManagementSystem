<x-guest-layout>
    <div class="min-h-screen bg-black flex flex-col items-center justify-center p-6">
        <div class="mb-8 text-center">
            <h1 class="text-5xl font-black uppercase tracking-tighter text-white leading-none">
                TONET <span class="text-red-600">SALON</span>
            </h1>
            <p class="text-[10px] text-gray-500 uppercase tracking-[0.4em] mt-3 font-bold">Unveil Your Shine</p>
        </div>

        <div class="w-full max-w-md bg-[#111111] border-t-4 border-red-600 p-10 shadow-2xl">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Email Address</label>
                    <input type="email" name="email" :value="old('email')" required autofocus 
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Password</label>
                    <input type="password" name="password" required 
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center text-[10px] uppercase font-bold text-gray-500">
                        <input type="checkbox" name="remember" class="bg-black border-gray-800 text-red-600 focus:ring-0 mr-2"> 
                        Remember Me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[10px] uppercase font-bold text-gray-600 hover:text-red-600 transition">
                            Forgot?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-red-600 text-white font-black uppercase tracking-widest py-4 text-xs hover:bg-white hover:text-black transition-all duration-300">
                    Sign In
                </button>
            </form>

            <div class="mt-10 text-center border-t border-gray-900 pt-6">
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-600">
                    New to the salon? 
                    <a href="{{ route('register') }}" class="text-red-600 hover:underline ml-1">Create Account</a>
                </p>
            </div>
        </div>

        <p class="mt-8 text-gray-700 text-[9px] uppercase tracking-widest font-bold">&copy; 2026 Tonet Salon Management System</p>
    </div>
</x-guest-layout>