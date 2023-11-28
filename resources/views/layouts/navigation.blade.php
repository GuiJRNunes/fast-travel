<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('tours.index')" :active="request()->routeIs('tours.index')">
                        {{ __('Tours') }}
                    </x-nav-link>
                </div>

                @if (Auth::user()->isAdmin())
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('tours.create')" :active="request()->routeIs('tours.create')">
                            {{ __('Create tour') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <div class="flex">

                @if (!Auth::user()->isAdmin())
                    {{-- Booking cart --}}
                    <div class="flex items-center ml-6">
                        <x-dropdown align="right" width="64">
                            <x-slot name="trigger">
                                <button class="text-gray-500 hover:text-gray-700" title="Shopping cart">
                                    @if ($user_bookings->count() > 0)
                                        <i
                                            class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full text-white flex items-center justify-center text-xs font-bold">
                                            {{ $user_bookings->count() }}
                                        </i>
                                    @endif
                                    <svg class="fill-current h-8 w-8" viewBox="0 0 96 96"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M28 72C23.6 72 20.04 75.6 20.04 80C20.04 84.4 23.6 88 28 88C32.4 88 36 84.4 36 80C36 75.6 32.4 72 28 72ZM4 8V16H12L26.4 46.36L21 56.16C20.36 57.28 20 58.6 20 60C20 64.4 23.6 68 28 68H76V60H29.68C29.12 60 28.68 59.56 28.68 59L28.8 58.52L32.4 52H62.2C65.2 52 67.84 50.36 69.2 47.88L83.52 21.92C83.84 21.36 84 20.68 84 20C84 17.8 82.2 16 80 16H20.84L17.08 8H4ZM68 72C63.6 72 60.04 75.6 60.04 80C60.04 84.4 63.6 88 68 88C72.4 88 76 84.4 76 80C76 75.6 72.4 72 68 72Z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="flex flex-col max-h-[80vh] overflow-auto text-gray-900">
                                    {{-- $user_bookings fetched on the ViewServiceProvider composer for this layout --}}
                                    @forelse ($user_bookings as $booking)
                                        <div class="p-2">
                                            <p class="font-bold whitespace-nowrap overflow-hidden text-ellipsis">
                                                {{ $booking->tour_title }}
                                            </p>
                                            <p class="text-right">
                                                {{ __('Passengers:') }} {{ $booking->number_of_passengers }}
                                            </p>
                                        </div>
                                        @if (!$loop->last)
                                            <div class="w-full h-[1px] bg-gray-400"></div>
                                        @endif
                                    @empty
                                        <div class="p-2">
                                            <p class="text-center">
                                                {{ __('No pending bookings') }}
                                            </p>
                                        </div>
                                    @endforelse
                                    <div class="bg-white px-2">
                                        <a href="{{ route('bookings.index') }}">
                                            <x-primary-button type="button" class="w-full justify-center">
                                                {{ __('Bookings') }}
                                            </x-primary-button>
                                        </a>
                                    </div>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  bg-white focus:outline-none transition ease-in-out duration-150
                                @if (Auth::user()->isAdmin()) text-orange-500 hover:text-orange-700 @else text-gray-500 hover:text-gray-700 @endif">
                                <div>
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (!Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('bookings.history')">
                                    {{ __('Bookings history') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center ml-6 sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('tours.index')" :active="request()->routeIs('tours.index')">
                {{ __('Tours') }}
            </x-responsive-nav-link>
        </div>

        @if (Auth::user()->isAdmin())
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('tours.create')" :active="request()->routeIs('tours.create')">
                    {{ __('Create tour') }}
                </x-responsive-nav-link>
            </div>
        @endif

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div
                    class="font-medium text-base @if (Auth::user()->isAdmin()) text-orange-500 @else text-gray-800 @endif">
                    {{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('bookings.history')">
                    {{ __('Bookings history') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
