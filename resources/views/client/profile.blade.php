@extends('layouts.app') 

@section('content')
<div x-data="{ open: false }" class="min-h-screen bg-black flex flex-col items-center justify-center">
    
    <button @click="open = true" class="bg-red-600 hover:bg-red-700 text-white font-black uppercase italic px-8 py-3 rounded shadow-2xl transition transform hover:scale-105">
        Edit Profile
    </button>

    <div x-show="open" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-md"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         style="display: none;">
        
        <div @click.away="open = false" class="bg-zinc-900 w-full max-w-md border border-zinc-800 p-8 rounded-xl shadow-2xl relative">
            
            <button @click="open = false" class="absolute top-4 right-4 text-gray-500 hover:text-white text-2xl">&times;</button>

            <header class="mb-8 text-center">
                <h2 class="text-3xl font-black uppercase italic tracking-tighter text-white">
                    Profile <span class="text-red-600">Settings</span>
                </h2>
            </header>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                           class="w-full bg-black border border-zinc-800 text-white p-3 rounded focus:border-red-600 outline-none transition">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                           class="w-full bg-black border border-zinc-800 text-white p-3 rounded focus:border-red-600 outline-none transition">
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 py-3 rounded font-black uppercase italic tracking-tighter transition">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection