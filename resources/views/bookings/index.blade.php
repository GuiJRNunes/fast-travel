<x-app-layout>
    @push('scripts')
        <script src="{{ Vite::asset('resources/js/bookings/index.js') }}"></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto bg-white shadow sm:rounded-lg p-4 sm:p-6 lg:p-8">
            @if (count($bookings) > 0)
                <form method="POST" action="{{ route('bookings.confirm') }}">
                    @csrf
                    @method('patch')

                    <div class="flex flex-col gap-4">
                        @foreach ($bookings as $booking)
                            <div class="border rounded-md border-gray-300 p-2 relative" data-booking>
                                <div>
                                    <h3 class="font-bold text-lg" data-booking-title>{{ $booking->tour->title }}</h3>
                                    <p data-booking-dates>{{ date('j M Y', strtotime($booking->tour->departure_date)) }}
                                        -
                                        {{ date('j M Y', strtotime($booking->tour->return_date)) }}</p>
                                </div>
                                <x-danger-button type="button" class="absolute top-2 right-2" title="Delete booking"
                                    x-on:click.prevent="$dispatch('open-modal', 'delete-booking-confirmation')"
                                    x-data=""
                                    data-delete-link="{{ route('bookings.destroy', ['booking' => $booking]) }}">
                                    X
                                </x-danger-button>

                                @php
                                    $input_id = 'number_of_passengers_' . $booking->id;
                                @endphp

                                <div class="flex justify-end items-center mt-4 gap-4">
                                    <x-text-input type="hidden" name="bookings[{{ $loop->index }}][id]"
                                        :value="$booking->id" />
                                    <div>
                                        <x-input-label for="{{ $input_id }}" :value="__('Number of passengers')" />
                                        <x-text-input type="number" id="{{ $input_id }}" class="block mt-1 w-full"
                                            name="bookings[{{ $loop->index }}][number_of_passengers]"
                                            :value="old(
                                                'bookings.' . $loop->index . '.number_of_passengers',
                                                $booking->number_of_passengers,
                                            )" required min="1" data-booking-number-of-passengers
                                            data-booking-price-per-passenger-value="{{ $booking->tour->price_per_passenger }}" />
                                        <x-input-error :messages="$errors->get('bookings.' . $loop->index . '.number_of_passengers')" class="mt-2" />
                                    </div>

                                    <span class="text-4xl font-bold">=</span>

                                    <ul class="flex-[0_0_100px] space-y-1 text-right">
                                        <li class="text-lg font-bold">Total price</li>
                                        <li data-booking-total-price>
                                            CA${{ number_format(
                                                old('bookings.' . $loop->index . '.number_of_passengers', $booking->number_of_passengers) *
                                                    $booking->tour->price_per_passenger,
                                                2,
                                            ) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 flex justify-end">
                        <x-primary-button>{{ __('Confirm') }}</x-primary-button>
                    </div>
                </form>
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <h3 class="text-4xl font-semibold text-gray-700"> {{ __('No pending bookings!') }}</h3>
                </div>
            @endif
        </div>
    </div>

    <x-modal id="delete-booking-confirmation" name="delete-booking-confirmation" focusable>
        <form method="POST" action="" class="p-4">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-900">
                {{ __('Are you sure you want to delete this booking?') }}
            </h2>

            <p class="mt-1 text-base text-gray-600" data-modal-content></p>

            <div class="mt-4 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete booking') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

</x-app-layout>
