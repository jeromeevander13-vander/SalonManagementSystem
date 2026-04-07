<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Photo Row -->
        <div class="flex flex-col sm:flex-row items-center gap-8 mb-8 pb-8 border-b border-red-900/20" x-data="{ photoName: null, photoPreview: null }">
            <div class="relative group">
                <!-- Current Profile Photo -->
                <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-red-900 bg-black flex items-center justify-center shadow-lg transition group-hover:border-red-600" x-show="!photoPreview">
                    @if($user->avatar)
                        <img src="{{ str_starts_with($user->avatar, 'avatars/') ? \Illuminate\Support\Facades\Storage::disk('s3')->url($user->avatar) : asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-4xl font-black text-white italic uppercase">{{ substr($user->name, 0, 1) }}</span>
                    @endif
                </div>

                <!-- New Photo Preview -->
                <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-red-600 bg-black flex items-center justify-center shadow-lg" x-show="photoPreview" x-cloak>
                    <img :src="photoPreview" class="w-full h-full object-cover">
                </div>

                <!-- Overlay for hover -->
                <button type="button" @click="$refs.photo.click()" class="absolute inset-0 rounded-full bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-xs font-black uppercase tracking-tighter italic">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Change
                </button>
            </div>

            <div class="flex-1 text-center sm:text-left">
                <h3 class="text-white font-black uppercase text-sm italic mb-1">Profile Magic</h3>
                <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-4 leading-relaxed">
                    Personalize your presence in our salon system. <br>
                    JPG, PNG or WEBP. Max 2MB.
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
                
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-red-600 font-bold uppercase italic italic tracking-widest"
                >{{ __('Updated.') }}</p>
            @endif
        </div>
    </form>
</section>
