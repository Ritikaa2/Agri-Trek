<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgriTrek | Contact Support</title>

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
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="btn-secondary">Home</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">Log In</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="shell-container py-10 md:py-14">
        <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="page-hero">
                <span class="section-badge">Support desk</span>
                <h1 class="mt-5 text-5xl font-semibold">We keep the field team moving.</h1>
                <p class="mt-4 max-w-xl text-base leading-8 text-muted">
                    Reach out if you need help with onboarding, application tracking, weather tools, or aerial data submission.
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

            <div class="panel-strong">
                <div class="mb-6">
                    <span class="section-badge">Send a request</span>
                    <h2 class="mt-5 text-4xl font-semibold">Tell us what you need.</h2>
                    <p class="mt-3 text-sm leading-7 text-muted">
                        We usually respond quickly for account, platform, and dataset support requests.
                    </p>
                </div>

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
                        <textarea id="message" name="message" rows="6" required class="field-textarea" placeholder="Describe the issue or request."></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send Securely</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="border-t border-[color:var(--line)] py-8">
        <div class="shell-container text-sm text-muted">
            <p>&copy; {{ date('Y') }} AgriTrek Agriculture Platform.</p>
        </div>
    </footer>
</body>
</html>
