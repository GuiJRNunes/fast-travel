<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100 selection:bg-sky-500 selection:text-white">

    {{-- Menu --}}
    @if (Route::has('login'))
        <div class="fixed top-0 right-0 p-6 text-right w-full bg-gray-100 z-10">
            @auth
                <a href="{{ url('/tours') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-sky-500">Tours</a>
            @else
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-sky-500">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-sky-500">Register</a>
                @endif
            @endauth
        </div>
    @endif

    {{-- Hero Section --}}
    <div class="relative sm:flex sm:justify-center sm:items-center">
        <div class="max-w-7xl mx-auto p-6 mt-24">
            <div class="flex items-end flex-wrap">
                <x-application-logo class="h-16 w-16 sm:h-32 sm:w-32 flex-none" />
                <h3 class="text-4xl sm:text-8xl font-semibold text-black leading-[0.75] sm:leading-[0.75]">ast Travel
                </h3>
                <p class="mt-4 text-xl text-gray-500 basis-full">We take you to where you want to go with <b>SPEED</b>,
                    <b>SECURITY</b> and <b>COMFORT</b>!
                </p>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <section id="footer" class="fixed bottom-0 w-full">
        <div class="bg-[url('../svg/welcome-wave.svg')] bg-center bg-no-repeat bg-cover w-full aspect-[960/320]">
        </div>
        <footer class="p-4 bg-sky-900 text-gray-100">
            <small>Copyright © {{ date('Y') }} Fast Travel (Fictional). All Rights Reserved.</small>
        </footer>
        <section>
</body>

</html>
