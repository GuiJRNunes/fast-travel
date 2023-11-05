@props(['disabled' => false, 'value' => ''])

<textarea 
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm']) !!}
>{{ $value }}</textarea>