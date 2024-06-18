@props(['active'])

@php
$classes = ($active ?? false)
            ? 'w-full relative px-3 py-1 flex items-center space-x-4 justify-start text-white rounded-lg group hover:bg-gray-300 hover:text-gray-500 bg-green-500'
            : 'w-full relative px-3 py-1 flex items-center space-x-4 justify-start text-gray-500 rounded-lg group hover:bg-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
