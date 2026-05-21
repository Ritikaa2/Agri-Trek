<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Government support</span>
            <div>
                <h1 class="page-title">Government schemes</h1>
                <p class="page-subtitle">Review available grants and subsidies that match your registered farmer profile.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container space-y-6">
        @if(session('success'))
            <div class="status-pill status-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="status-pill status-danger">{{ session('error') }}</div>
        @endif

        <div class="panel">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h2 class="text-3xl font-semibold">Available subventions and grants</h2>
                    <p class="mt-3 text-sm leading-7 text-muted">
                        Explore central and state-level agricultural support programs tailored to land and KYC context.
                    </p>
                </div>
                <a href="{{ route('farmer.applications.index') }}" class="btn-primary">View My Applications</a>
            </div>
        </div>

        <div class="space-y-5">
            @foreach($schemes as $scheme)
                <div class="panel-strong">
                    <div class="grid gap-6 lg:grid-cols-[1fr_auto]">
                        <div>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="status-pill status-warning">Active scheme</span>
                                <span class="status-pill status-info">Auto-eligibility: verified</span>
                            </div>
                            <h2 class="mt-5 text-3xl font-semibold">{{ $scheme->name }}</h2>
                            <p class="mt-4 text-sm leading-7 text-muted">{{ $scheme->description }}</p>

                            <div class="mt-6 grid gap-4 md:grid-cols-2">
                                <div class="panel-soft">
                                    <p class="eyebrow">Key benefits</p>
                                    <p class="mt-2 text-sm leading-7 text-muted">{{ $scheme->benefits }}</p>
                                </div>
                                <div class="panel-soft">
                                    <p class="eyebrow">Eligibility</p>
                                    <p class="mt-2 text-sm leading-7 text-muted">{{ $scheme->eligibility_criteria }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col justify-between gap-4 lg:w-72">
                            <div class="panel-soft">
                                <p class="eyebrow">Application deadline</p>
                                <p class="mt-2 text-lg font-semibold text-[color:var(--danger)]">{{ \Carbon\Carbon::parse($scheme->deadline)->format('F j, Y') }}</p>
                            </div>

                            <div class="space-y-3">
                                @if(in_array($scheme->id, $appliedSchemeIds))
                                    @php($application = $applicationsByScheme->get($scheme->id))
                                    <button disabled class="btn-ghost w-full cursor-not-allowed justify-center">
                                        Applied - {{ ucfirst($application->status) }}
                                    </button>
                                    <a href="{{ route('farmer.applications.index') }}" class="btn-secondary w-full justify-center">Track Application</a>
                                @else
                                    <form action="{{ route('farmer.schemes.apply', $scheme) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="btn-primary w-full justify-center">Apply Now</button>
                                    </form>
                                @endif

                                @if($scheme->government_link)
                                    <a href="{{ $scheme->government_link }}" target="_blank" rel="noopener noreferrer" class="btn-secondary w-full justify-center">
                                        External Govt Website
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
