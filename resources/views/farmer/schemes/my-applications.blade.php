<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Application tracking</span>
            <div>
                <h1 class="page-title">My applications</h1>
                <p class="page-subtitle">Track the current status of every scheme application tied to your profile.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container space-y-6">
        <div class="panel">
            <h2 class="text-3xl font-semibold">Application overview</h2>
            <p class="mt-3 max-w-3xl text-sm leading-7 text-muted">
                Review submission dates, live statuses, and direct links back to the related government portal where available.
            </p>
        </div>

        @if($applications->isEmpty())
            <div class="empty-state">
                <h2 class="text-3xl font-semibold">No applications yet</h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-muted">
                    You have not applied for any government schemes yet. Browse the available programs to get started.
                </p>
                <a href="{{ route('farmer.schemes.index') }}" class="btn-primary mt-6">Browse Available Schemes</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($applications as $application)
                    <div class="panel">
                        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <h2 class="text-2xl font-semibold">{{ $application->scheme->name }}</h2>
                                <p class="mt-2 text-sm text-muted">Applied on {{ \Carbon\Carbon::parse($application->application_date)->format('F j, Y') }}</p>
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                @if($application->status === 'pending')
                                    <span class="status-pill status-warning">Pending Review</span>
                                @elseif($application->status === 'approved')
                                    <span class="status-pill status-success">Approved</span>
                                @elseif($application->status === 'rejected')
                                    <span class="status-pill status-danger">Rejected</span>
                                @endif

                                @if($application->scheme->government_link)
                                    <a href="{{ $application->scheme->government_link }}" target="_blank" rel="noopener noreferrer" class="btn-secondary">
                                        Govt Website
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
