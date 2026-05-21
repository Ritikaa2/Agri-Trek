<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Aerial intake</span>
            <div>
                <h1 class="page-title">Upload aerial dataset</h1>
                <p class="page-subtitle">
                    Submit a labeled trajectory file to start clustering and automated analysis routines.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container">
        <div class="grid gap-6 xl:grid-cols-[0.42fr_0.58fr]">
            <div class="panel">
                <span class="section-badge">Submission notes</span>
                <h2 class="mt-5 text-3xl font-semibold">Prepare the dataset before upload.</h2>
                <p class="mt-4 text-sm leading-7 text-muted">
                    Use a clear batch label and attach a CSV or JSON file containing the trajectory coordinates needed for clustering.
                </p>

                <div class="mt-8 space-y-4">
                    <div class="panel-soft">
                        <p class="eyebrow">Accepted formats</p>
                        <p class="mt-2 text-sm leading-7 text-muted">CSV, JSON, and compatible text exports up to 10MB.</p>
                    </div>
                    <div class="panel-soft">
                        <p class="eyebrow">Best practice</p>
                        <p class="mt-2 text-sm leading-7 text-muted">Name batches by sector, survey run, or field region for easier downstream review.</p>
                    </div>
                </div>
            </div>

            <div class="panel-strong">
                <div class="mb-8">
                    <h2 class="text-3xl font-semibold">Initialize trajectory clustering</h2>
                    <p class="mt-3 text-sm leading-7 text-muted">
                        Once uploaded, the dataset becomes available for analysis and map-based review.
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.aerial.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="field">
                        <label for="batch_name" class="field-label">Dataset Batch Label</label>
                        <input type="text" name="batch_name" id="batch_name" required placeholder="Northern Sector Alpha Scan" class="field-input" value="{{ old('batch_name') }}">
                        <x-input-error :messages="$errors->get('batch_name')" class="mt-2" />
                    </div>

                    <div class="field">
                        <label class="field-label">Trajectory Data File</label>
                        <label for="dataset_file" class="flex cursor-pointer flex-col items-center justify-center rounded-[1.75rem] border border-dashed border-[rgba(45,124,75,0.28)] bg-[rgba(220,233,222,0.38)] px-6 py-12 text-center transition hover:bg-[rgba(220,233,222,0.52)]">
                            <span class="section-badge">Upload file</span>
                            <h3 class="mt-5 text-2xl font-semibold">Drop your CSV or JSON file here.</h3>
                            <p class="mt-3 text-sm leading-7 text-muted">Or click to choose a file from your device.</p>
                            <input id="dataset_file" name="dataset_file" type="file" class="sr-only" required accept=".csv,.json,.txt">
                            <p class="mt-5 text-xs font-bold uppercase tracking-[0.22em] text-muted">CSV or JSON up to 10MB</p>
                        </label>
                        <x-input-error :messages="$errors->get('dataset_file')" class="mt-2" />
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <a href="{{ route('dashboard') }}" class="btn-secondary">Cancel</a>
                        <button type="submit" class="btn-primary">Upload and Analyze</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
