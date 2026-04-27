<x-guest-layout>
    <div class="min-h-screen bg-black flex flex-col items-center justify-center p-6">
        <div class="mb-8 text-center">
            <h1 class="text-5xl font-black uppercase tracking-tighter text-white leading-none">
                NEW <span class="text-red-600">BEGINNING</span>
            </h1>
            <p class="text-[10px] text-gray-500 uppercase tracking-[0.4em] mt-3 font-bold">Set your new access code</p>
        </div>

        <div class="w-full max-w-md bg-[#111111] border-l-4 border-red-600 p-10 shadow-2xl">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-5">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus readonly
                        class="w-full bg-black border-gray-800 text-gray-500 focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">New Password</label>
                    <input type="password" name="password" required autocomplete="new-password"
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <p class="text-[9px] text-gray-600 font-bold uppercase mt-2 tracking-widest">Min. 8 chars, mixed case, number & symbol</p>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-8">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="w-full bg-red-600 text-white font-black uppercase tracking-widest py-4 text-xs hover:bg-white hover:text-black transition-all duration-300">
                    {{ __('Reset Password') }}
                </button>
            </form>
        </div>

        <p class="mt-8 text-gray-700 text-[9px] uppercase tracking-widest font-bold">&copy; 2026 Tonet Salon Management System</p>
    </div>
</x-guest-layout>
