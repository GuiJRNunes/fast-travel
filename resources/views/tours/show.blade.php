<x-app-layout>
    @push('scripts')
        <script src="{{ Vite::asset('resources/js/tours/show.js') }}"></script>
        <script>
            price_per_passenger = {{ $tour->price_per_passenger }};
        </script>
    @endpush
    @php
        $available_spots = $tour->availableSpots();
    @endphp
    <div class="max-w-2xl mx-auto">
        {{-- Image --}}
        <div class="h-48 w-full bg-center bg-no-repeat bg-cover" style="background-image: url({{ $tour->image_link }});">
        </div>

        <div class="max-full p-4 bg-white sm:p-6 lg:p-8">
            <div class="flex-1 flex-col p-6 text-gray-900">
                {{-- Title and options menu --}}
                <div class="flex justify-between items-start">
                    <span class="text-xl">{{ $tour->title }}</span>
                    @if (Auth::user()->isAdmin())
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('tours.edit', $tour)">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>

                {{-- Tour characteristics --}}
                <ul class="text-sm text-gray-700 space-y-1 mt-1">
                    <li>{{ date('j M Y', strtotime($tour->departure_date)) }} -
                        {{ date('j M Y', strtotime($tour->return_date)) }}</li>
                    <li>{{ $available_spots }} Available spots</li>
                    @if (Auth::user()->isAdmin())
                        <li>
                            <x-chip>{{ $tour->status->title() }}</x-chip>
                        </li>
                    @endif
                </ul>

                {{-- Description --}}
                <p class="mt-4 text-lg text-justify">
                    {{ $tour->description }}
                </p>

                {{-- Pricing --}}
                <p class="mt-4 text-xl font-semibold text-right">
                    CA$ {{ number_format($tour->price_per_passenger, 2) }}
                </p>

                {{-- Booking form --}}
                <form method="POST" action="{{ route('bookings.store', ['tour' => $tour, 'user' => Auth::user()]) }}">
                    @csrf

                    <div class="flex justify-end items-center mt-4 gap-4">
                        <div>
                            <x-input-label for="number_of_passengers" :value="__('Number of passengers')" />
                            <x-text-input type="number" id="number_of_passengers" class="block mt-1 w-full"
                                name="number_of_passengers" :value="old('number_of_passengers', 1)" required min="1"
                                max="{{ $available_spots }}" />
                            <x-input-error :messages="$errors->get('number_of_passengers')" class="mt-2" />
                        </div>

                        <span class="text-4xl font-bold">=</span>

                        <ul class="flex-[0_0_100px] space-y-1 text-right">
                            <li class="text-lg font-bold">Total price</li>
                            <li id="total_price">
                                CA${{ number_format(old('number_of_passengers', 1) * $tour->price_per_passenger, 2) }}
                            </li>
                        </ul>
                    </div>

                    <div class="flex justify-between mt-4">
                        <a href="{{ route('tours.index') }}">
                            <x-danger-button type="button">
                                {{ __('Cancel') }}
                            </x-danger-button>
                        </a>
                        <x-primary-button>{{ __('Book tour') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
