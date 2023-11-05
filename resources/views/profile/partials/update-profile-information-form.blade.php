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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6">
        @csrf
        @method('patch')

        <div class="flex flex-wrap gap-4">
            <div class="@if ($user->isAdmin()) max-w-xl @endif flex-auto basis-64 space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                        required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                        required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
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
            </div>

            {{-- Contact info --}}
            @if (!$user->isAdmin())    
            <div class="flex-auto basis-64 space-y-4">
                <!-- Telephone -->
                <div>
                    <x-input-label for="telephone" :value="__('Telephone number')" />
                    <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" required
                        :value="old('telephone', $user->telephone)" />
                    <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                </div>
                <!-- Street Address -->
                <div>
                    <x-input-label for="street_address" :value="__('Address')" />
                    <x-text-input id="street_address" class="block mt-1 w-full" type="text" name="street_address" required
                        :value="old('street_address', $user->street_address)" />
                    <x-input-error :messages="$errors->get('street_address')" class="mt-2" />
                </div>
            </div>

            <div class="flex-auto basis-64 space-y-4">
                <!-- Country -->
                <div>
                    <x-input-label for="country" :value="__('Country')" />
                    <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" required
                        :value="old('country', $user->country)" />
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>
                <div class="flex gap-4">
                    <!-- City -->
                    <div class="flex-[1_0_60%]">
                        <x-input-label for="city" :value="__('City')" />
                        <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" required
                            :value="old('city', $user->city)" />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>
                    <!-- Postal Code -->
                    <div class="flex-[0_1_auto]">
                        <x-input-label for="postal_code" :value="__('Postal code')" />
                        <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" required :value="old('postal_code', $user->postal_code)" />
                        <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
