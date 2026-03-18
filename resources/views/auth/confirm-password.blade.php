<x-guest-layout>
    <div class="min-h-screen bg-black flex flex-col items-center justify-center p-6">
        <div class="mb-8 text-center">
            <h1 class="text-5xl font-black uppercase tracking-tighter text-white leading-none">
                SECURE <span class="text-red-600">AREA</span>
            </h1>
            <p class="text-[10px] text-gray-500 uppercase tracking-[0.4em] mt-3 font-bold">Please confirm your identity</p>
        </div>

        <div class="w-full max-w-md bg-[#111111] border-t-4 border-red-600 p-10 shadow-2xl">
            <div class="mb-6 text-sm text-gray-400 font-medium">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-8">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Password</label>
                    <input type="password" name="password" required autocomplete="current-password" autofocus
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <button type="submit" class="w-full bg-red-600 text-white font-black uppercase tracking-widest py-4 text-xs hover:bg-white hover:text-black transition-all duration-300">
                    {{ __('Confirm') }}
                </button>
            </form>
        </div>

        <p class="mt-8 text-gray-700 text-[9px] uppercase tracking-widest font-bold">&copy; 2026 Tonet Salon Management System</p>
    </div>
</x-guest-layout>
