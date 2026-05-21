<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Farmer workspace</span>
            <div>
                <h1 class="page-title">Welcome back, {{ auth()->user()->name }}</h1>
                <p class="page-subtitle">
                    Review your land records, active applications, forecasts, and field support tools from one place.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container space-y-6">
        <div class="panel-strong">
            <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-end">
                <div>
                    <span class="section-badge">Daily field brief</span>
                    <h2 class="mt-5 text-4xl font-semibold">A calmer view of your farm operations.</h2>
                    <p class="mt-4 max-w-3xl text-base leading-8 text-muted">
                        Keep plot records tidy, watch market movement, check the forecast, and move through scheme activity without switching visual context.
                    </p>
                </div>
                <a href="{{ route('farmer.lands.create') }}" class="btn-primary">Register New Land</a>
            </div>
        </div>

        @if(!auth()->user()->farmer)
            <div class="info-banner">
                <div class="mt-1 h-10 w-10 shrink-0 rounded-full bg-[rgba(199,134,50,0.14)]"></div>
                <div class="flex-1">
                    <h2 class="text-2xl font-semibold">Complete your KYC profile</h2>
                    <p class="mt-2 text-sm leading-7 text-muted">
                        Finish Aadhaar and address verification to unlock land registration and government scheme applications.
                    </p>
                </div>
                <a href="{{ route('farmer.kyc.create') }}" class="btn-primary">Complete KYC</a>
            </div>
        @endif

        <div class="grid gap-5 md:grid-cols-2">
            <a href="{{ route('farmer.lands.index') }}" class="metric-card block">
                <p class="eyebrow">Registered plots</p>
                <p class="mt-3 text-5xl font-semibold">{{ auth()->user()->farmer ? auth()->user()->farmer->lands()->count() : 0 }}</p>
                <p class="mt-2 text-sm text-muted">Track crop, soil, and location records per land entry.</p>
            </a>
            <a href="{{ route('farmer.applications.index') }}" class="metric-card block">
                <p class="eyebrow">Pending applications</p>
                <p class="mt-3 text-5xl font-semibold">{{ auth()->user()->farmer ? auth()->user()->farmer->applications()->where('status', 'pending')->count() : 0 }}</p>
                <p class="mt-2 text-sm text-muted">Government submissions currently awaiting review.</p>
            </a>
        </div>

        <div class="panel">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-3xl font-semibold">Smart farming tools</h2>
                    <p class="mt-3 text-sm leading-7 text-muted">Jump into the tools you use most often during the season.</p>
                </div>
            </div>

            <div class="mt-8 grid gap-5 md:grid-cols-3">
                <a href="{{ route('farmer.weather.index') }}" class="metric-card block">
                    <p class="eyebrow">Weather</p>
                    <h3 class="mt-3 text-2xl font-semibold">Agri-weather</h3>
                    <p class="mt-3 text-sm leading-7 text-muted">Forecast timing for spraying, irrigation, and field visits.</p>
                </a>
                <a href="{{ route('farmer.mandi.index') }}" class="metric-card block">
                    <p class="eyebrow">Markets</p>
                    <h3 class="mt-3 text-2xl font-semibold">Live mandi prices</h3>
                    <p class="mt-3 text-sm leading-7 text-muted">Watch real-time commodity movement and portfolio signals.</p>
                </a>
                <a href="{{ route('farmer.ai.index') }}" class="metric-card block">
                    <p class="eyebrow">Advisory</p>
                    <h3 class="mt-3 text-2xl font-semibold">Agronomist AI</h3>
                    <p class="mt-3 text-sm leading-7 text-muted">Ask crop questions or upload an image for guided analysis.</p>
                </a>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
            <div class="panel">
                <span class="section-badge">Satellite and drone notes</span>
                <h2 class="mt-5 text-3xl font-semibold">Recent remote sensing highlights</h2>
                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <div class="panel-soft">
                        <p class="eyebrow">Crop vigor</p>
                        <h3 class="mt-2 text-xl font-semibold">NDVI improving</h3>
                        <p class="mt-3 text-sm leading-7 text-muted">
                            Primary polygon health appears up by 14% over the last 30 days, with no immediate fertilization urgency.
                        </p>
                    </div>
                    <div class="panel-soft">
                        <p class="eyebrow">Moisture watch</p>
                        <h3 class="mt-2 text-xl font-semibold">Localized water stress</h3>
                        <p class="mt-3 text-sm leading-7 text-muted">
                            Minor stress is visible in the north-west zone, suggesting isolated irrigation rather than full-plot watering.
                        </p>
                    </div>
                </div>
            </div>

            <div class="panel">
                <span class="section-badge">Scheme opportunities</span>
                <h2 class="mt-5 text-3xl font-semibold">Government support is ready to review.</h2>
                <p class="mt-4 text-sm leading-7 text-muted">
                    Browse active grants for irrigation, seed support, and equipment subsidies through your verified farmer profile.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('farmer.schemes.index') }}" class="btn-primary">Browse Schemes</a>
                    <a href="{{ route('farmer.applications.index') }}" class="btn-secondary">View My Applications</a>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
                <div>
                    <span class="section-badge">Support line</span>
                    <h2 class="mt-5 text-3xl font-semibold">Need help with a field or platform issue?</h2>
                    <p class="mt-4 text-sm leading-7 text-muted">
                        Contact the support team for application guidance, workflow questions, or agronomy review help.
                    </p>
                    <div class="mt-8 panel-soft">
                        <p class="eyebrow">Contact</p>
                        <p class="mt-2 text-lg font-semibold">support@agritrek.com</p>
                    </div>
                </div>

                <div class="panel-soft">
                    @if(session('success'))
                        <div class="status-pill status-success mb-4">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                        <div class="field">
                            <label for="message" class="field-label">Message the Support Team</label>
                            <textarea name="message" id="message" rows="5" required class="field-textarea" placeholder="Describe your farming issue or platform question."></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Submit Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
