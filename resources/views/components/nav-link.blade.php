@props(['active'])

@php
$classes = ($active ?? false)
? 'text-[#41759D]'
: 'hover:text-[#41759D] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>