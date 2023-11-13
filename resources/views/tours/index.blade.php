<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Filters') }}
        </h2>

        <form method="POST" action="{{ route('tours.index') }}">
            @csrf
            @method('get')

            <div class="flex items-end gap-4">
                <!-- Initial departure date -->
                <div class="mt-4">
                    <x-input-label for="initial_departure_date" :value="__('Initial departure date')" />
                    <x-text-input type="date" id="initial_departure_date" class="block mt-1 w-full" name="initial_departure_date"
                        :value="old('initial_departure_date', date('Y-m-d'))" />
                    <x-input-error :messages="$errors->get('initial_departure_date')" class="mt-2" />
                </div>

                <!-- Final departure date -->
                <div class="mt-4">
                    <x-input-label for="final_departure_date" :value="__('Final departure date')" />
                    <x-text-input type="date" id="final_departure_date" class="block mt-1 w-full" name="final_departure_date"
                        :value="old('final_departure_date', date('Y-m-d', strtotime('+7 days')))" />
                    <x-input-error :messages="$errors->get('final_departure_date')" class="mt-2" />
                </div>

                <!-- Initial return date -->
                <div class="mt-4">
                    <x-input-label for="initial_return_date" :value="__('Initial return date')" />
                    <x-text-input type="date" id="initial_return_date" class="block mt-1 w-full" name="initial_return_date"
                        :value="old('initial_return_date', date('Y-m-d', strtotime('+7 days')))" />
                    <x-input-error :messages="$errors->get('initial_return_date')" class="mt-2" />
                </div>
                
                <!-- Final return date -->
                <div class="mt-4">
                    <x-input-label for="final_return_date" :value="__('Final return date')" />
                    <x-text-input type="date" id="final_return_date" class="block mt-1 w-full" name="final_return_date"
                        :value="old('final_return_date', date('Y-m-d', strtotime('+14 days')))" />
                    <x-input-error :messages="$errors->get('final_return_date')" class="mt-2" />
                </div>

                <!-- Price per passenger -->
                <div class="mt-4">
                    <x-input-label for="price_per_passenger" :value="__('Price per passenger')" />
                    <x-text-input type="number" id="price_per_passenger" class="block mt-1 w-full"
                        name="price_per_passenger" :value="old('price_per_passenger')" step="0.01" />
                    <x-input-error :messages="$errors->get('price_per_passenger')" class="mt-2" />
                </div>

                <x-primary-button>{{ __('Submit') }}</x-primary-button>
            </div>
        </form>
    </x-slot> --}}

    <div
        class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 grid gap-4 
                lg:grid-cols-[repeat(3,minmax(200px,_1fr))] 
                md:grid-cols-[repeat(2,minmax(200px,_1fr))]
                sm:grid-cols-[repeat(1,minmax(200px,_1fr))]">
        @foreach ($tours as $tour)
            {{-- Tour container --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg flex flex-col">
                {{-- Image --}}
                <div class="h-32 w-full bg-center bg-no-repeat bg-cover"
                    style="background-image: url({{ $tour->image_link }});">
                </div>

                <div class="p-6 text-gray-900 flex-auto flex flex-col justify-between">
                    <div>
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
                            <!-- TODO : Load proper value for available spots -->
                            {{-- <li>{{ $tour->capacity }} Available spots</li> --}}
                            @if (Auth::user()->isAdmin())
                                <li>
                                    <x-chip>{{ $tour->status->title() }}</x-chip>
                                </li>
                            @endif
                        </ul>

                        {{-- Description --}}
                        <p class="mt-4 text-lg text-justify">
                            @php
                                if (Str::length($tour->description) > 200) {
                                    echo Str::substr($tour->description, 0, 200) . '...';
                                } else {
                                    echo $tour->description;
                                }
                            @endphp
                        </p>
                    </div>

                    {{-- Footer --}}
                    <div class="flex justify-between mt-4">
                        <span class="text-xl font-semibold text-right">
                            CA$ {{ $tour->price_per_passenger }}
                        </span>
                        <div class="flex justify-end">
                            <a href="{{ route('tours.show', $tour) }}">
                                <x-primary-button type="button">
                                    {{ __('Book') }}
                                </x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        {{ $tours->links() }}
    </div>
</x-app-layout>
