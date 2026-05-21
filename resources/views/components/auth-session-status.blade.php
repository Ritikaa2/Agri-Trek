@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'status-pill status-success']) }}>
        {{ $status }}
    </div>
@endif
