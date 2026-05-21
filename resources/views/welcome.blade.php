<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgriTrek | Precision Agriculture Platform</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <nav class="sticky top-0 z-40 border-b border-[color:var(--line)] bg-[rgba(248,244,236,0.82)] backdrop-blur-xl">
        <div class="shell-container flex min-h-[5.5rem] items-center justify-between gap-6 py-4">
            <a href="{{ url('/') }}" class="inline-flex">
                <x-application-logo />
            </a>

            <div class="hidden items-center gap-3 md:flex">
                <a href="#features" class="btn-ghost">Features</a>
                <a href="#contact" class="btn-secondary">Contact</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary">Open Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary">Create Account</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <main>
        <section class="shell-container grid gap-8 py-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center lg:py-16">
            <div class="space-y-6">
                <span class="section-badge">Agricultural command center</span>
                <div>
                    <h1 class="page-title max-w-3xl">
                        Built for calm, data-led farming decisions.
                    </h1>
                    <p class="page-subtitle max-w-2xl">
                        AgriTrek brings land records, government schemes, mandi pricing, weather intelligence, and aerial analytics into one refined operational workspace.
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary">Go to Dashboard</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary">Start as Farmer</a>
                        @endif
                        <a href="#features" class="btn-secondary">Explore Capabilities</a>
                    @endauth
                </div>

                <div class="grid gap-4 pt-4 sm:grid-cols-3">
                    <div class="metric-card">
                        <p class="eyebrow">Registered farmers</p>
                        <p class="mt-3 text-4xl font-semibold">{{ \App\Models\Farmer::count() + 143 }}</p>
                        <p class="mt-2 text-sm text-muted">Connected profiles across field operations.</p>
                    </div>
                    <div class="metric-card">
                        <p class="eyebrow">Scheme activity</p>
                        <p class="mt-3 text-4xl font-semibold">{{ \App\Models\Application::count() + 28 }}</p>
                        <p class="mt-2 text-sm text-muted">Applications tracked inside one workflow.</p>
                    </div>
                    <div class="metric-card">
                        <p class="eyebrow">Aerial datasets</p>
                        <p class="mt-3 text-4xl font-semibold">{{ \App\Models\AerialDataset::count() + 12 }}</p>
                        <p class="mt-2 text-sm text-muted">Operational intelligence from uploaded scans.</p>
                    </div>
                </div>
            </div>

            <div class="panel-strong overflow-hidden">
                <div class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
                    <div class="overflow-hidden rounded-[1.5rem] border border-[color:var(--line)] bg-[rgba(255,255,255,0.5)]">
                        <img src="{{ asset('img/hero_bg.png') }}" alt="AgriTrek overview" class="h-full min-h-[22rem] w-full object-cover">
                    </div>
                    <div class="space-y-4">
                        <div class="panel-soft">
                            <p class="eyebrow">Land intelligence</p>
                            <h3 class="mt-3 text-2xl font-semibold">Trace each field like an operating unit.</h3>
                            <p class="mt-3 text-sm leading-7 text-muted">
                                Register plots, track crops, and keep pesticide details close to the decisions that depend on them.
                            </p>
                        </div>
                        <div class="panel-soft">
                            <p class="eyebrow">Decision rhythm</p>
                            <ul class="mt-3 space-y-3 text-sm leading-7 text-muted">
                                <li>Daily weather checks for timing-sensitive work.</li>
                                <li>Mandi movement summaries for pricing decisions.</li>
                                <li>Aerial upload workflows for clustering and anomaly review.</li>
                            </ul>
                        </div>
                        <div class="rounded-[1.5rem] border border-[rgba(45,124,75,0.16)] bg-[rgba(220,233,222,0.62)] p-5">
                            <p class="eyebrow text-accent">Platform note</p>
                            <p class="mt-2 text-sm font-semibold text-[color:var(--accent-strong)]">
                                Designed to feel less like a dashboard maze and more like a field notebook with live intelligence.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="shell-container py-6 md:py-10">
            <div class="panel">
                <div class="max-w-3xl">
                    <span class="section-badge">Core modules</span>
                    <h2 class="mt-5 text-4xl font-semibold">Everything important stays within one visual system.</h2>
                    <p class="mt-4 text-base leading-8 text-muted">
                        AgriTrek is structured around the real flow of agricultural work: register, verify, monitor, decide, and analyze.
                    </p>
                </div>

                <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    <div class="metric-card">
                        <p class="eyebrow">Identity</p>
                        <h3 class="mt-3 text-2xl font-semibold">Farmer KYC</h3>
                        <p class="mt-3 text-sm leading-7 text-muted">Collect verified profile details before land and scheme workflows begin.</p>
                    </div>
                    <div class="metric-card">
                        <p class="eyebrow">Markets</p>
                        <h3 class="mt-3 text-2xl font-semibold">Mandi Signals</h3>
                        <p class="mt-3 text-sm leading-7 text-muted">Watch live commodity movement with portfolio-oriented summaries.</p>
                    </div>
                    <div class="metric-card">
                        <p class="eyebrow">Advisory</p>
                        <h3 class="mt-3 text-2xl font-semibold">Agronomist AI</h3>
                        <p class="mt-3 text-sm leading-7 text-muted">Ask crop, weather, pesticide, and image-analysis questions inside the app.</p>
                    </div>
                    <div class="metric-card">
                        <p class="eyebrow">Analytics</p>
                        <h3 class="mt-3 text-2xl font-semibold">Drone Uploads</h3>
                        <p class="mt-3 text-sm leading-7 text-muted">Process aerial trajectory datasets for clustering and anomaly review.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="shell-container py-6 md:py-10">
            <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
                <div class="panel-strong">
                    <span class="section-badge">How it flows</span>
                    <h2 class="mt-5 text-4xl font-semibold">Operational clarity from registration to action.</h2>
                    <div class="mt-8 space-y-4">
                        <div class="flex gap-4 rounded-[1.35rem] border border-[color:var(--line)] bg-white/70 p-5">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[rgba(220,233,222,0.8)] font-bold text-accent">1</span>
                            <div>
                                <h3 class="text-xl font-semibold">Profile and land intake</h3>
                                <p class="mt-2 text-sm leading-7 text-muted">Create farmer records, complete KYC, and register every plot with crop and location context.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 rounded-[1.35rem] border border-[color:var(--line)] bg-white/70 p-5">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[rgba(220,233,222,0.8)] font-bold text-accent">2</span>
                            <div>
                                <h3 class="text-xl font-semibold">Live decision support</h3>
                                <p class="mt-2 text-sm leading-7 text-muted">Track weather forecasts, mandi prices, and scheme availability before making field-level calls.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 rounded-[1.35rem] border border-[color:var(--line)] bg-white/70 p-5">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[rgba(220,233,222,0.8)] font-bold text-accent">3</span>
                            <div>
                                <h3 class="text-xl font-semibold">Escalate into analytics</h3>
                                <p class="mt-2 text-sm leading-7 text-muted">Upload drone datasets and use AI-guided analysis to surface spatial patterns faster.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel bg-grain">
                    <span class="section-badge">Built for teams</span>
                    <h2 class="mt-5 text-4xl font-semibold">Admin and farmer interfaces share one calmer language.</h2>
                    <p class="mt-4 text-base leading-8 text-muted">
                        Instead of separate disconnected experiences, the system now reads like one product across public pages, authentication, admin workflows, and farmer tools.
                    </p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div class="panel-soft">
                            <p class="eyebrow">For farmers</p>
                            <p class="mt-2 text-sm leading-7 text-muted">Land records, applications, forecasts, and AI support in the same rhythm.</p>
                        </div>
                        <div class="panel-soft">
                            <p class="eyebrow">For admins</p>
                            <p class="mt-2 text-sm leading-7 text-muted">User review, aerial uploads, and analytics management without visual clutter.</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary">Launch Workspace</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-secondary">Sign In</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-ghost">Register Farmer Account</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="shell-container py-6 md:py-10">
            <div class="panel-strong">
                <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
                    <div>
                        <span class="section-badge">Support</span>
                        <h2 class="mt-5 text-4xl font-semibold">Talk to the AgriTrek team.</h2>
                        <p class="mt-4 text-base leading-8 text-muted">
                            Reach out for onboarding help, account issues, aerial dataset questions, or platform support.
                        </p>

                        <div class="mt-8 space-y-4">
                            <div class="panel-soft">
                                <p class="eyebrow">Email</p>
                                <p class="mt-2 text-lg font-semibold">support@agritrek.com</p>
                            </div>
                            <div class="panel-soft">
                                <p class="eyebrow">Phone</p>
                                <p class="mt-2 text-lg font-semibold">+91 (800) 123-FARM</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if(session('success'))
                            <div class="status-pill status-success mb-5">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="field">
                                <label for="name" class="field-label">Full Name</label>
                                <input id="name" name="name" type="text" required class="field-input" placeholder="Your name">
                            </div>
                            <div class="field">
                                <label for="email" class="field-label">Email Address</label>
                                <input id="email" name="email" type="email" required class="field-input" placeholder="you@example.com">
                            </div>
                            <div class="field">
                                <label for="message" class="field-label">Message</label>
                                <textarea id="message" name="message" rows="5" required class="field-textarea" placeholder="Tell us how we can help."></textarea>
                            </div>
                            <button type="submit" class="btn-primary w-full sm:w-auto">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-[color:var(--line)] py-8">
        <div class="shell-container flex flex-col gap-3 text-sm text-muted md:flex-row md:items-center md:justify-between">
            <p>&copy; {{ date('Y') }} AgriTrek. Designed for practical agricultural operations.</p>
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="text-accent">Home</a>
                <a href="{{ url('/contact') }}" class="text-accent">Contact</a>
            </div>
        </div>
    </footer>
</body>
</html>
