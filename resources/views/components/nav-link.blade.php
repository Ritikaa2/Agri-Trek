@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center rounded-full px-4 py-2 text-sm font-bold text-[color:var(--accent-strong)] bg-[rgba(220,233,222,0.9)] border border-[rgba(45,124,75,0.18)] shadow-sm transition'
        : 'inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold text-[color:var(--muted)] border border-transparent transition hover:border-[rgba(45,124,75,0.14)] hover:bg-white/70 hover:text-[color:var(--ink)]';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
