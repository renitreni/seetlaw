@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-teal-950 focus:ring-teal-950 rounded-md shadow-sm']) !!}>
