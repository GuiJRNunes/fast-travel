@props(['options' => [], 'selected' => ''])

<select {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm',
]) !!}>
    @foreach ($options as $option)
        <option 
          value="{{ $option['value'] }}" 
          @selected($option['value'] == $selected)>
            {{$option['option']}}
        </option>
    @endforeach
</select>