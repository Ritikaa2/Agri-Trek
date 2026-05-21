@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full rounded-[1.1rem] px-4 py-3 text-sm font-bold text-[color:var(--accent-strong)] bg-[rgba(220,233,222,0.9)] border border-[rgba(45,124,75,0.18)]'
        : 'block w-full rounded-[1.1rem] px-4 py-3 text-sm font-semibold text-[color:var(--ink)] transition hover:bg-white/80';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
