<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking history') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto bg-white shadow sm:rounded-lg p-4 sm:p-6 lg:p-8">
            @if (count($bookings) > 0)
                <div class="flex flex-col gap-4">
                    @foreach ($bookings as $booking)
                        <div class="border rounded-md border-gray-300 p-2 relative" data-booking>
                            <div>
                                <h3 class="font-bold text-lg" data-booking-title>{{ $booking->tour->title }}</h3>
                                <p data-booking-dates>{{ date('j M Y', strtotime($booking->tour->departure_date)) }} -
                                    {{ date('j M Y', strtotime($booking->tour->return_date)) }}</p>
                            </div>

                            <div class="mt-4 space-y-1">
                                <ul class="flex gap-1 items-end">
                                    <li class="text-lg font-bold flex-[0_0_110px]">Passengers</li>
                                    <li>{{ $booking->number_of_passengers }}</li>
                                </ul>

                                <ul class="flex gap-1 items-end">
                                    <li class="text-lg font-bold flex-[0_0_110px]">Base price</li>
                                    <li>CA${{ $booking->tour->price_per_passenger }}</li>
                                </ul>

                                <ul class="flex gap-1 items-end">
                                    <li class="text-lg font-bold flex-[0_0_110px]">Total price</li>
                                    <li>
                                        CA${{ $booking->number_of_passengers * $booking->tour->price_per_passenger }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <h3 class="text-4xl font-semibold text-gray-700"> {{ __('No booking history!') }}</h3>
                </div>
            @endif
        </div>

        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            {{ $bookings->links() }}
        </div>
    </div>

</x-app-layout>
