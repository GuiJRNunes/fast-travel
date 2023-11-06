<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 bg-white sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('tours.update', $tour) }}">
            @csrf
            @method('patch')

            {{-- Image link --}}
            <div>
                <x-input-label for="image_link" :value="__('Image link')" />
                <x-text-input id="image_link" class="block mt-1 w-full" type="text" name="image_link" :value="old('image_link', $tour->image_link)"
                    required autofocus />
                <x-input-error :messages="$errors->get('image_link')" class="mt-2" />
            </div>

            {{-- Title --}}
            <div class="mt-4">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $tour->title)"
                    required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            {{-- Description --}}
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-textarea id="description" class="block mt-1 w-full min-h-[200px]" name="description"
                    :value="old('description', $tour->description)" required />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="flex flex-col sm:flex-row sm:gap-4">
                {{-- Departure Date --}}
                <div class="mt-4 flex-auto">
                    <x-input-label for="departure_date" :value="__('Date of departure')" />
                    <x-text-input type="date" id="departure_date" class="block mt-1 w-full" name="departure_date"
                        :value="old('departure_date', $tour->departure_date)" required />
                    <x-input-error :messages="$errors->get('departure_date')" class="mt-2" />
                </div>

                {{-- Return Date --}}
                <div class="mt-4 flex-auto">
                    <x-input-label for="return_date" :value="__('Date of return')" />
                    <x-text-input type="date" id="return_date" class="block mt-1 w-full" name="return_date"
                        :value="old('return_date', $tour->return_date)" required />
                    <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
                </div>

                {{-- Capacity --}}
                <div class="mt-4 flex-auto">
                    <x-input-label for="capacity" :value="__('Capacity')" />
                    <x-text-input type="number" id="capacity" class="block mt-1 w-full" name="capacity"
                        :value="old('capacity', $tour->capacity)" required />
                    <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:gap-4">
                {{-- Price per passenger --}}
                <div class="mt-4 flex-auto">
                    <x-input-label for="price_per_passenger" :value="__('Price per passenger')" />
                    <x-text-input type="number" id="price_per_passenger" class="block mt-1 w-full"
                        name="price_per_passenger" :value="old('price_per_passenger', $tour->price_per_passenger)" required step="0.01" />
                    <x-input-error :messages="$errors->get('price_per_passenger')" class="mt-2" />
                </div>

                {{-- Status --}}
                <div class="mt-4 flex-auto">
                    <x-input-label for="status" :value="__('Status')" />
                    <x-select id="status" class="block mt-1 w-full" name="status" required :options="App\Enum\TourStatusEnum::getSelectOptions()"
                        :selected="old('status', $tour->status->value)" />
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>

            <div class="mt-4 flex justify-between">
                <x-danger-button x-on:click.prevent="window.location.href='{{ route('tours.index') }}'">
                    {{ __('Cancel') }}
                </x-danger-button>
                
                <x-primary-button>
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
