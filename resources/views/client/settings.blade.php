<div>
    <div class="mb-8 border-b border-white/5 pb-6">
        <h2 class="text-3xl font-black text-white uppercase italic tracking-tighter">Account <span class="text-red-600">Settings</span></h2>
        <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.4em] mt-3 flex items-center">
            <span class="w-8 h-[1px] bg-red-600 mr-3"></span>
            Update your profile information and account security
        </p>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Profile Information -->
        <div class="bg-card-dark border border-red-900/40 rounded-xl p-8 shadow-xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-red-600 to-transparent opacity-50"></div>
            
            <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="flex flex-col md:flex-row items-center gap-8 mb-8 pb-8 border-b border-white/5">
                    <div class="relative group" x-data="{ photoPreview: null }">
                        <div class="w-32 h-32 rounded-2xl overflow-hidden border-2 border-red-900 bg-black flex items-center justify-center shadow-2xl transition group-hover:border-red-600" x-show="!photoPreview">
                            @if(Auth::user()->avatar)
                                <img src="{{ str_starts_with(Auth::user()->avatar, 'avatars/') ? \Illuminate\Support\Facades\Storage::disk('s3')->url(Auth::user()->avatar) : asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-4xl font-black text-white italic uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="w-32 h-32 rounded-2xl overflow-hidden border-2 border-red-600 bg-black flex items-center justify-center shadow-2xl" x-show="photoPreview" x-cloak>
                            <img :src="photoPreview" class="w-full h-full object-cover">
                        </div>
                        <button type="button" @click="$refs.photo.click()" class="absolute inset-0 rounded-2xl bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-[10px] font-black uppercase tracking-widest italic">
                            Change Photo
                        </button>
                        <input type="file" class="hidden" x-ref="photo" name="avatar" @change="const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result; }; reader.readAsDataURL($event.target.files[0]);">
                    </div>
                    <div class="text-center md:text-left">
                        <h3 class="text-white font-black uppercase text-sm italic mb-1">Profile Identity</h3>
                        <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest leading-relaxed">Update your display name and email address. Your photo will be visible across the platform.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full bg-black/40 border-white/10 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 rounded-lg transition-all">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="w-full bg-black/40 border-white/10 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 rounded-lg transition-all">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-widest py-3 px-8 rounded-lg text-[10px] transition-all shadow-lg active:scale-95">Save Changes</button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-[10px] text-green-500 font-black uppercase tracking-widest">Profile Updated!</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Password Update -->
        <div class="bg-card-dark border border-red-900/40 rounded-xl p-8 shadow-xl relative overflow-hidden">
             <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-gray-600 to-transparent opacity-50"></div>
             
             <h3 class="text-white font-black uppercase text-sm italic mb-6">Security & Password</h3>
             
             <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Current Password</label>
                        <input type="password" name="current_password" class="w-full bg-black/40 border-white/10 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 rounded-lg transition-all">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">New Password</label>
                        <input type="password" name="password" class="w-full bg-black/40 border-white/10 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 rounded-lg transition-all">
                        <p class="text-[9px] text-gray-600 font-bold uppercase mt-1 tracking-tighter">Min. 8 chars, mixed case, number & symbol</p>
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-500">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full bg-black/40 border-white/10 text-white focus:border-red-600 focus:ring-0 text-sm py-3 px-4 rounded-lg transition-all">
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="bg-white/5 hover:bg-white/10 border border-white/10 text-white font-black uppercase tracking-widest py-3 px-8 rounded-lg text-[10px] transition-all shadow-lg active:scale-95">Update Password</button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-[10px] text-green-500 font-black uppercase tracking-widest">Password Changed!</p>
                    @endif
                </div>
             </form>
        </div>

        <!-- Danger Zone -->
        <div class="bg-red-950/10 border border-red-900/20 rounded-xl p-8 shadow-xl">
             <h3 class="text-red-500 font-black uppercase text-sm italic mb-2">Danger Zone</h3>
             <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-6">Once you delete your account, there is no going back. Please be certain.</p>
             
             <button @click="showDeleteModal = true" class="bg-red-600/20 hover:bg-red-600 border border-red-600/30 text-red-500 hover:text-white font-black uppercase tracking-widest py-3 px-8 rounded-lg text-[10px] transition-all shadow-lg active:scale-95">Delete Account</button>
        </div>
    </div>
</div>
