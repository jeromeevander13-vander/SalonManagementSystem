<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-white uppercase tracking-tighter leading-tight">
            {{ __('Account') }} <span class="text-red-600">{{ __('Settings') }}</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-8 bg-[#111] border-l-4 border-gray-800 shadow sm:rounded-none">
                <div class="max-w-xl text-white">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-[#111] border-l-4 border-red-600 shadow sm:rounded-none">
                <div class="max-w-xl text-white">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 bg-[#111] border-l-4 border-red-900 shadow sm:rounded-none opacity-80 hover:opacity-100 transition">
                <div class="max-w-xl text-white">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
            
        </div>
    </div>

    
</x-app-layout>