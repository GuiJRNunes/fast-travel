<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col items-center p-6 bg-sky-700 sm:justify-center">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-black" />
            </a>
        </div>

        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg max-w-md sm:max-w-2xl">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-[1_1_50%]">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex-[1_1_50%]">
                        <!-- Telephone -->
                        <div>
                            <x-input-label for="telephone" :value="__('Telephone number')" />
                            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone"
                                required autocomplete="tel" :value="old('telephone')" />
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                        </div>

                        <!-- Street Address -->
                        <div class="mt-4">
                            <x-input-label for="street_address" :value="__('Address')" />
                            <x-text-input id="street_address" class="block mt-1 w-full" type="text"
                                name="street_address" required autocomplete="street-address" :value="old('street_address')" />
                            <x-input-error :messages="$errors->get('street_address')" class="mt-2" />
                        </div>

                        <!-- Country -->
                        <div class="mt-4">
                            <x-input-label for="country" :value="__('Country')" />
                            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country"
                                required autocomplete="country-name" :value="old('country')" />
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <div class="flex gap-2">
                            <!-- City -->
                            <div class="mt-4 flex-[1_0_60%]">
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                    required autocomplete="on" :value="old('city')" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>

                            <!-- Postal Code -->
                            <div class="mt-4 flex-[0_1_auto]">
                                <x-input-label for="postal_code" :value="__('Postal code')" />
                                <x-text-input id="postal_code" class="block mt-1 w-full" type="text"
                                    name="postal_code" required autocomplete="postal-code" :value="old('postal_code')" />
                                <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>

                <!-- TODO : Remove this -->
                {{--
                <div class="flex items-center justify-between mt-4">
                    <x-secondary-button onclick="event.preventDefault();setUp();">
                        {{ __('Test') }}
                    </x-secondary-button>
                </div>

                <script>
                    function setUp() {
                        document.querySelector('#name').value = 'Guilherme';
                        document.querySelector('#email').value = 'a@a.a';
                        document.querySelector('#password').value = '12345678';
                        document.querySelector('#password_confirmation').value = '12345678';
                        document.querySelector('#telephone').value = '55 51 999447504';
                        document.querySelector('#street_address').value = '11116 95A St NW';
                        document.querySelector('#country').value = 'Canada';
                        document.querySelector('#city').value = 'Edmonton';
                        document.querySelector('#postal_code').value = 'XXX XXX';
                    }
                </script> --}}
            </form>
        </div>
    </div>
</body>

</html>
