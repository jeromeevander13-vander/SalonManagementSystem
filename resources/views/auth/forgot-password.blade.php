<x-guest-layout>
    <div class="min-h-screen bg-black flex flex-col items-center justify-center p-6">
        <div class="mb-8 text-center">
            <h1 class="text-5xl font-black uppercase tracking-tighter text-white leading-none">
                RESET <span class="text-red-600">SHINE</span>
            </h1>
            <p class="text-[10px] text-gray-500 uppercase tracking-[0.4em] mt-3 font-bold">Recover your account access</p>
        </div>

        <div class="w-full max-w-md bg-[#111111] border-r-4 border-red-600 p-10 shadow-2xl">
            <div class="mb-6 text-sm text-gray-400 font-medium">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6 font-bold text-[10px] uppercase tracking-widest text-green-500 border border-green-900 bg-green-950/20 p-3" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-8">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Email Address</label>
                    <input type="email" name="email" :value="old('email')" required autofocus 
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full bg-red-600 text-white font-black uppercase tracking-widest py-4 text-xs hover:bg-white hover:text-black transition-all duration-300">
                        {{ __('Email Password Reset Link') }}
                    </button>
                    
                    <a href="{{ route('login') }}" class="text-center text-[10px] uppercase font-black tracking-widest text-gray-600 hover:text-red-600 transition-all duration-300">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>

        <p class="mt-8 text-gray-700 text-[9px] uppercase tracking-widest font-bold">&copy; 2026 Tonet Salon Management System</p>
    </div>
</x-guest-layout>
