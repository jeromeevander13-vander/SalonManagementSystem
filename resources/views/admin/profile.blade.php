@php
    $user = auth()->user();
@endphp

<div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-white/5 pb-8">
    <div>
        <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter leading-none">Profile <span class="text-red-600">Settings</span></h1>
        <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.4em] mt-3 flex items-center">
            <span class="w-8 h-[1px] bg-red-600 mr-3"></span>
            Manage Your System Credentials
        </p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Profile Info Column -->
    <div class="lg:col-span-2 space-y-8">
        
        <!-- Update Profile Info Card -->
        <div class="bg-card-dark border border-red-900/30 rounded-[2rem] p-8 shadow-2xl relative overflow-hidden group hover:border-red-600/50 transition-all duration-500">
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>

            <h2 class="text-xl font-black text-white uppercase italic tracking-widest mb-8 flex items-center">
                <span class="w-2 h-2 bg-red-600 rounded-full mr-3 animate-pulse"></span>
                Basic Information
            </h2>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <!-- Avatar Upload Section -->
                <div class="flex flex-col sm:flex-row items-center gap-8 mb-10 p-6 bg-black/40 rounded-3xl border border-white/5" x-data="{ photoName: null, photoPreview: null }">
                    <div class="relative group/avatar">
                        <div class="w-32 h-32 rounded-3xl overflow-hidden border-2 border-red-900 bg-black flex items-center justify-center shadow-2xl transition group-hover/avatar:border-red-600 group-hover/avatar:scale-105 duration-500" x-show="!photoPreview">
                            @if($user->avatar)
                                <img src="{{ str_starts_with($user->avatar, 'avatars/') ? \Illuminate\Support\Facades\Storage::disk('s3')->url($user->avatar) : asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-5xl font-black text-white italic uppercase">{{ substr($user->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="w-32 h-32 rounded-3xl overflow-hidden border-2 border-red-600 bg-black flex items-center justify-center shadow-2xl" x-show="photoPreview" x-cloak>
                            <img :src="photoPreview" class="w-full h-full object-cover">
                        </div>
                        
                        <button type="button" @click="$refs.photo.click()" class="absolute inset-0 rounded-3xl bg-black/60 opacity-0 group-hover/avatar:opacity-100 transition flex items-center justify-center text-white text-[10px] font-black uppercase tracking-widest italic backdrop-blur-sm">
                            <svg class="w-6 h-6 mb-1 block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </button>
                    </div>

                    <div class="flex-1 text-center sm:text-left">
                        <h3 class="text-white font-black uppercase text-xs italic mb-2 tracking-widest">Admin Identity</h3>
                        <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-4 leading-relaxed max-w-xs">
                            Recommended: Square image, max 2MB. <br>
                            This avatar will be visible across the system.
                        </p>
                        
                        <input type="file" class="hidden" x-ref="photo" name="avatar"
                            @change="
                                photoName = $event.target.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($event.target.files[0]);
                            ">
                        
                        @if($errors->get('avatar'))
                            <p class="text-red-500 text-[9px] font-black uppercase mt-2">{{ $errors->get('avatar')[0] }}</p>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-[0.2em]">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-black/50 border border-red-900/30 text-white text-xs rounded-xl px-5 py-4 outline-none focus:border-red-600 transition font-bold uppercase tracking-wider" required>
                        @if($errors->get('name'))
                            <p class="text-red-500 text-[9px] font-black uppercase mt-2">{{ $errors->get('name')[0] }}</p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-[0.2em]">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-black/50 border border-red-900/30 text-white text-xs rounded-xl px-5 py-4 outline-none focus:border-red-600 transition font-bold uppercase tracking-wider" required>
                        @if($errors->get('email'))
                            <p class="text-red-500 text-[9px] font-black uppercase mt-2">{{ $errors->get('email')[0] }}</p>
                        @endif
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="bg-red-700 hover:bg-red-600 text-white text-[10px] font-black uppercase tracking-[0.3em] px-10 py-4 rounded-xl transition shadow-[0_10px_20px_rgba(185,28,28,0.2)] active:scale-95">
                        Update Identity
                    </button>
                    
                    @if (session('status') === 'profile-updated')
                        <span class="ml-4 text-[10px] font-black text-green-500 uppercase tracking-widest animate-pulse">Configuration Saved.</span>
                    @endif
                </div>
            </form>
        </div>

        <!-- Update Password Card -->
        <div class="bg-card-dark border border-red-900/30 rounded-[2rem] p-8 shadow-2xl relative overflow-hidden group hover:border-red-600/50 transition-all duration-500">
            <h2 class="text-xl font-black text-white uppercase italic tracking-widest mb-8 flex items-center">
                <span class="w-2 h-2 bg-red-600 rounded-full mr-3 animate-pulse"></span>
                Security Protocol
            </h2>

            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-[0.2em]">Current Password</label>
                        <input type="password" name="current_password" class="w-full bg-black/50 border border-red-900/30 text-white text-xs rounded-xl px-5 py-4 outline-none focus:border-red-600 transition font-bold" required>
                        @if($errors->updatePassword->get('current_password'))
                            <p class="text-red-500 text-[9px] font-black uppercase mt-2">{{ $errors->updatePassword->get('current_password')[0] }}</p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-[0.2em]">New Password</label>
                        <input type="password" name="password" class="w-full bg-black/50 border border-red-900/30 text-white text-xs rounded-xl px-5 py-4 outline-none focus:border-red-600 transition font-bold" required>
                        @if($errors->updatePassword->get('password'))
                            <p class="text-red-500 text-[9px] font-black uppercase mt-2">{{ $errors->updatePassword->get('password')[0] }}</p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-[0.2em]">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full bg-black/50 border border-red-900/30 text-white text-xs rounded-xl px-5 py-4 outline-none focus:border-red-600 transition font-bold" required>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="bg-red-700 hover:bg-red-600 text-white text-[10px] font-black uppercase tracking-[0.3em] px-10 py-4 rounded-xl transition shadow-[0_10px_20px_rgba(185,28,28,0.2)] active:scale-95">
                        Upgrade Security
                    </button>
                    
                    @if (session('status') === 'password-updated')
                        <span class="ml-4 text-[10px] font-black text-green-500 uppercase tracking-widest animate-pulse">Security Patch Applied.</span>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Stats/Info Sidebar -->
    <div class="space-y-8">
        <div class="premium-glass rounded-[2rem] p-8 border border-red-900/30">
            <h3 class="text-white font-black uppercase text-sm italic mb-6 tracking-widest">Admin Stats</h3>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 text-[10px] font-black uppercase">Role</span>
                    <span class="text-red-600 text-[10px] font-black uppercase tracking-widest bg-red-600/10 px-3 py-1 rounded-full border border-red-600/20 italic">Master Administrator</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 text-[10px] font-black uppercase">Active Since</span>
                    <span class="text-white text-[10px] font-black uppercase italic">{{ $user->created_at->format('M Y') }}</span>
                </div>
                <div class="h-[1px] bg-white/5"></div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 text-[10px] font-black uppercase">Account Status</span>
                    <span class="text-green-500 text-[10px] font-black uppercase italic flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        Verified
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-red-900/10 rounded-[2rem] p-8 border border-red-900/20 group">
            <h3 class="text-red-500 font-black uppercase text-sm italic mb-4 tracking-widest">Danger Zone</h3>
            <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest leading-relaxed mb-6">
                Permanently remove your account and all associated data from the system.
            </p>
            <button @click="showDeleteModal = true" class="w-full bg-transparent border border-red-900/50 hover:bg-red-900/20 text-red-500 text-[10px] font-black uppercase tracking-[0.3em] py-4 rounded-xl transition duration-300">
                Decommission Account
            </button>
        </div>
    </div>
</div>

<!-- Deletion Modal -->
<div x-show="showDeleteModal" 
     class="fixed inset-0 z-[70] overflow-y-auto flex items-center justify-center p-4" 
     x-cloak>
    <div class="fixed inset-0 bg-black bg-opacity-90 backdrop-blur-sm transition-opacity" @click="showDeleteModal = false"></div>

    <div class="relative w-full max-w-md bg-[#0a0a0a] border border-red-900 rounded-[2rem] p-10 shadow-2xl" @click.stop>
        <h2 class="text-2xl font-black text-white uppercase italic tracking-tighter mb-4">Final <span class="text-red-600">Confirmation</span></h2>
        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-8 leading-relaxed">
            This action is irreversible. All your data will be purged from the system. Please enter your password to confirm.
        </p>

        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
            @csrf
            @method('delete')

            <div>
                <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-widest">Administrator Password</label>
                <input type="password" name="password" class="w-full bg-black border border-red-900/30 text-white text-xs rounded-xl px-5 py-4 outline-none focus:border-red-600 transition font-bold" placeholder="••••••••" required>
                @if($errors->userDeletion->get('password'))
                    <p class="text-red-500 text-[9px] font-black uppercase mt-2">{{ $errors->userDeletion->get('password')[0] }}</p>
                @endif
            </div>

            <div class="flex flex-col gap-4">
                <button type="submit" class="w-full bg-red-700 hover:bg-red-600 text-white text-[10px] font-black uppercase tracking-[0.3em] py-4 rounded-xl transition shadow-lg">
                    Confirm Destruction
                </button>
                <button type="button" @click="showDeleteModal = false" class="text-center text-[9px] font-black uppercase text-gray-500 hover:text-white transition tracking-[0.4em]">
                    Abort Mission
                </button>
            </div>
        </form>
    </div>
</div>

