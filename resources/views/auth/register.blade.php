<x-guest-layout>
    <div class="min-h-screen bg-black flex flex-col items-center justify-center p-6">
        <div class="mb-8 text-center">
            <h1 class="text-5xl font-black uppercase tracking-tighter text-white leading-none">
                JOIN <span class="text-red-600">THE SHINE</span>
            </h1>
            <p class="text-[10px] text-gray-500 uppercase tracking-[0.4em] mt-3 font-bold text-center">Create your Tonet Salon account</p>
        </div>

        <div class="w-full max-w-md bg-[#111111] border-l-4 border-red-600 p-10 shadow-2xl">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-5">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Full Name</label>
                    <input type="text" name="name" :value="old('name')" required autofocus 
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-5">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Email Address</label>
                    <input type="email" name="email" :value="old('email')" required 
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-5">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Password</label>
                    <input type="password" name="password" required autocomplete="new-password"
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" required 
                        class="w-full bg-black border-gray-800 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 transition-all">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="w-full bg-red-600 text-white font-black uppercase tracking-widest py-4 text-xs hover:bg-white hover:text-black transition-all duration-300">
                    Register Account
                </button>
            </form>

            <div class="mt-8 text-center border-t border-gray-900 pt-6">
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-600">
                    Already a member? 
                    <a href="{{ route('login') }}" class="text-red-600 hover:underline ml-1">Log In Here</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>