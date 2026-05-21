<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Land records</span>
            <div>
                <h1 class="page-title">My lands and crops portfolio</h1>
                <p class="page-subtitle">Manage plot details, crop plans, and treatment records in one organized view.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container space-y-6">
        <div class="panel">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-3xl font-semibold">Registered land profiles</h2>
                    <p class="mt-3 text-sm leading-7 text-muted">
                        Each entry captures area, location, crop planning, and treatment context for field decisions.
                    </p>
                </div>
                <a href="{{ route('farmer.lands.create') }}" class="btn-primary">Add Land Profile</a>
            </div>
        </div>

        @if($lands->isEmpty())
            <div class="empty-state">
                <h2 class="text-3xl font-semibold">No land profiles yet</h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-muted">
                    Start by registering your first plot to unlock agronomy insights, weather workflows, and scheme context.
                </p>
                <a href="{{ route('farmer.lands.create') }}" class="btn-primary mt-6">Start Registration</a>
            </div>
        @else
            <div class="grid gap-5 lg:grid-cols-2 xl:grid-cols-3">
                @foreach($lands as $index => $land)
                    <div class="metric-card">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="eyebrow">Plot {{ $index + 1 }}</p>
                                <h2 class="mt-2 text-2xl font-semibold">Plot #{{ $land->id }}</h2>
                                <p class="mt-2 text-sm font-semibold text-accent">{{ $land->area_in_acres }} acres</p>
                            </div>
                            <span class="status-pill status-info">{{ $land->soil_type }} soil</span>
                        </div>

                        <div class="mt-6 space-y-3 text-sm text-muted">
                            <div class="panel-soft">
                                <p class="eyebrow">Primary crop</p>
                                <p class="mt-2 text-base font-semibold text-[color:var(--ink)]">{{ $land->crop_type ?: 'Not set' }}</p>
                            </div>

                            @if($land->crops_details)
                                <div class="panel-soft">
                                    <p class="eyebrow">Rotation details</p>
                                    <p class="mt-2 leading-7">{{ Str::limit($land->crops_details, 80) }}</p>
                                </div>
                            @endif

                            <div class="grid gap-3 sm:grid-cols-2">
                                <div class="panel-soft">
                                    <p class="eyebrow">Pesticides</p>
                                    <p class="mt-2 text-sm font-semibold text-[color:var(--ink)]">{{ $land->pesticide_usage ?: 'None' }}</p>
                                </div>
                                <div class="panel-soft">
                                    <p class="eyebrow">Insecticides</p>
                                    <p class="mt-2 text-sm font-semibold text-[color:var(--ink)]">{{ $land->insecticide_usage ?: 'None' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between border-t border-[color:var(--line)] pt-4 text-xs font-semibold uppercase tracking-[0.16em] text-muted">
                            <span>{{ $land->location_coords }}</span>
                            <span>{{ $land->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
