<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Workspace</span>
            <div>
                <h1 class="page-title">AgriTrek dashboard</h1>
                <p class="page-subtitle">Your role-specific tools and records are available from this shared command surface.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container">
        <div class="panel-strong">
            <h2 class="text-3xl font-semibold">You are logged in.</h2>
            <p class="mt-3 max-w-2xl text-base leading-8 text-muted">
                Use the navigation above to continue into your farmer or admin workflows.
            </p>
        </div>
    </div>
</x-app-layout>
