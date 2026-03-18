<x-guest-layout>
    <div class="min-h-screen bg-black flex flex-col items-center justify-center p-6">
        <div class="mb-8 text-center">
            <h1 class="text-5xl font-black uppercase tracking-tighter text-white leading-none">
                VERIFY <span class="text-red-600">EMAIL</span>
            </h1>
            <p class="text-[10px] text-gray-500 uppercase tracking-[0.4em] mt-3 font-bold">One more step to shine</p>
        </div>

        <div class="w-full max-w-md bg-[#111111] border-l-4 border-red-600 p-10 shadow-2xl">
            <div class="mb-6 text-sm text-gray-400 font-medium">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 font-bold text-[10px] uppercase tracking-widest text-green-500 border border-green-900 bg-green-950/20 p-3">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <div class="flex flex-col gap-4 mt-6">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 text-white font-black uppercase tracking-widest py-4 text-xs hover:bg-white hover:text-black transition-all duration-300">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="text-[10px] uppercase font-black tracking-widest text-gray-600 hover:text-red-600 transition-all duration-300">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>

        <p class="mt-8 text-gray-700 text-[9px] uppercase tracking-widest font-bold">&copy; 2026 Tonet Salon Management System</p>
    </div>
</x-guest-layout>
