<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Admin operations</span>
            <div>
                <h1 class="page-title">Command center</h1>
                <p class="page-subtitle">
                    Review farmer activity, track scheme demand, and manage aerial analysis inputs from one clear control surface.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container space-y-6">
        <div class="panel-strong">
            <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-end">
                <div>
                    <span class="section-badge">Daily overview</span>
                    <h2 class="mt-5 text-4xl font-semibold">Welcome back, {{ auth()->user()->name }}.</h2>
                    <p class="mt-4 max-w-3xl text-base leading-8 text-muted">
                        Monitor user growth, active scheme participation, and aerial clustering throughput without switching contexts.
                    </p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('admin.users.index') }}" class="btn-secondary">Manage Users</a>
                    <a href="{{ route('admin.aerial.create') }}" class="btn-primary">Upload Aerial Data</a>
                </div>
            </div>
        </div>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            <div class="metric-card">
                <p class="eyebrow">Registered farmers</p>
                <p class="mt-3 text-5xl font-semibold">{{ \App\Models\Farmer::count() }}</p>
                <p class="mt-2 text-sm text-muted">Farmer records currently in the system.</p>
            </div>
            <div class="metric-card">
                <p class="eyebrow">Applications</p>
                <p class="mt-3 text-5xl font-semibold">{{ \App\Models\Application::count() }}</p>
                <p class="mt-2 text-sm text-muted">Total scheme applications tracked.</p>
            </div>
            <div class="metric-card">
                <p class="eyebrow">Schemes</p>
                <p class="mt-3 text-5xl font-semibold">{{ \App\Models\Scheme::count() }}</p>
                <p class="mt-2 text-sm text-muted">Government programs currently available.</p>
            </div>
            <div class="metric-card">
                <p class="eyebrow">Clusters</p>
                <p class="mt-3 text-5xl font-semibold">{{ \App\Models\Cluster::count() }}</p>
                <p class="mt-2 text-sm text-muted">Generated aerial analysis clusters.</p>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
            <div class="panel">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-3xl font-semibold">Quick command modules</h2>
                        <p class="mt-2 text-sm leading-7 text-muted">Navigate directly into the administrative workflows used most often.</p>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <a href="{{ route('admin.users.index') }}" class="metric-card block">
                        <p class="eyebrow">User directory</p>
                        <h3 class="mt-3 text-2xl font-semibold">Review farmers and officers</h3>
                        <p class="mt-3 text-sm leading-7 text-muted">Check roles, KYC completion, and identity details.</p>
                    </a>
                    <a href="{{ route('admin.aerial.create') }}" class="metric-card block">
                        <p class="eyebrow">Dataset intake</p>
                        <h3 class="mt-3 text-2xl font-semibold">Submit drone trajectory data</h3>
                        <p class="mt-3 text-sm leading-7 text-muted">Start clustering and anomaly analysis for uploaded scans.</p>
                    </a>
                </div>
            </div>

            <div class="panel">
                <span class="section-badge">System note</span>
                <h2 class="mt-5 text-3xl font-semibold">Analytics queue is ready.</h2>
                <p class="mt-4 text-sm leading-7 text-muted">
                    When new aerial datasets arrive, this workspace becomes the staging point for clustering, review, and downstream reporting.
                </p>

                <div class="mt-8 space-y-4">
                    <div class="panel-soft">
                        <p class="eyebrow">Expected file types</p>
                        <p class="mt-2 text-sm leading-7 text-muted">CSV and JSON trajectory files are accepted for processing.</p>
                    </div>
                    <div class="panel-soft">
                        <p class="eyebrow">Current status</p>
                        <p class="mt-2 text-sm font-semibold text-accent">No blocking alerts detected for the admin queue.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
