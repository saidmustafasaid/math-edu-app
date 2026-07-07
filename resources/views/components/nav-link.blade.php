@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold bg-indigo-600 text-white'
    : 'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition duration-150 cursor-pointer';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
