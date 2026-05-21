@props(['light' => false])

@php
    $wordmarkClasses = $light ? 'text-white' : 'text-[color:var(--ink)]';
    $submarkClasses = $light ? 'text-emerald-50/75' : 'text-[color:var(--muted)]';
@endphp

<div {{ $attributes->except('light')->merge(['class' => 'group inline-flex items-center gap-3']) }}>
    <div class="relative flex h-12 w-12 items-center justify-center overflow-hidden rounded-[1.1rem] border border-[rgba(45,124,75,0.18)] bg-[linear-gradient(135deg,#f3e2c9,#dce9de)] shadow-[0_12px_24px_rgba(45,124,75,0.16)] transition duration-300 group-hover:-translate-y-0.5">
        <div class="absolute inset-x-0 top-0 h-1/2 bg-[linear-gradient(180deg,rgba(255,255,255,0.78),transparent)]"></div>
        <svg class="relative h-7 w-7 text-[color:var(--accent-strong)]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M12 20c4.5-3 7-6.85 7-10.2A4.8 4.8 0 0 0 14.1 5c-.87 0-1.72.24-2.47.68A4.82 4.82 0 0 0 9.18 5 4.8 4.8 0 0 0 5 9.8C5 13.15 7.5 17 12 20Z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M12 8.5v7m-2.8-4.2c1.5.25 3.2.25 5.6 0" />
        </svg>
    </div>
    <div class="flex flex-col">
        <span class="font-serif text-2xl font-semibold leading-none {{ $wordmarkClasses }}">AgriTrek</span>
        <span class="text-[0.66rem] font-extrabold uppercase tracking-[0.28em] {{ $submarkClasses }}">Field Intelligence</span>
    </div>
</div>
