@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block py-2 pr-4 pl-3 text-white bg-indigo-700 rounded md:bg-transparent md:text-indigo-500 md:p-0'
                : 'block py-2 pr-4 pl-3 text-gray-300 hover:bg-indigo-500 md:hover:bg-transparent md:border-0 md:hover:text-indigo-400 md:p-0 rounded';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
