<x-app-layout>
    <div
        class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 grid gap-4 
                lg:grid-cols-[repeat(3,minmax(200px,_1fr))] 
                md:grid-cols-[repeat(2,minmax(200px,_1fr))]
                sm:grid-cols-[repeat(1,minmax(200px,_1fr))]">
        @foreach ($tours as $tour)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a href="{{ route('tours.show', $tour) }}">
                    <div class="h-32 w-full bg-center bg-no-repeat bg-cover hover:cursor-pointer hover:blur-sm transition ease-in-out duration-300"
                        style="background-image: url({{ $tour->image_link }});">
                    </div>
                </a>
                <div class="flex-1 flex-col p-6 text-gray-900">
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
                    <ul class="text-sm text-gray-700 space-y-1 mt-1">
                        <li>{{ date('j M Y', strtotime($tour->departure_date)) }} -
                            {{ date('j M Y', strtotime($tour->return_date)) }}</li>
                        @if (Auth::user()->isAdmin())
                            <li>
                                <x-chip>{{ $tour->status->title() }}</x-chip>
                            </li>
                        @endif
                        <li>{{ $tour->capacity }} Available spots</li>
                    </ul>
                    <p class="mt-4 text-lg text-justify">
                        @php
                            if (Str::length($tour->description) > 200) {
                                echo Str::substr($tour->description, 0, 200) . '...';
                            } else {
                                echo $tour->description;
                            }
                        @endphp
                    </p>
                    <p class="mt-4 text-xl font-semibold text-right">
                        CA$ {{ $tour->price_per_passenger }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
