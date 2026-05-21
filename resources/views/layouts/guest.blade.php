<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AgriTrek | Access Portal</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="auth-layout">
            <aside class="auth-side">
                <div class="relative z-10 px-12 py-12 xl:px-16">
                    <a href="{{ url('/') }}" class="inline-flex">
                        <x-application-logo light />
                    </a>
                </div>

                <div class="relative z-10 px-12 pb-16 xl:px-16">
                    <div class="max-w-xl space-y-6 text-white">
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.28em]">
                            Precision platform
                        </span>
                        <h1 class="text-5xl font-semibold leading-tight text-white xl:text-6xl">
                            A calmer control room for modern farm operations.
                        </h1>
                        <p class="max-w-lg text-base leading-8 text-emerald-50/82">
                            Track land records, farmer identity, market signals, and aerial datasets through one clear operational workspace.
                        </p>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur-sm">
                                <p class="text-xs font-bold uppercase tracking-[0.22em] text-emerald-100/70">Coverage</p>
                                <p class="mt-2 text-3xl font-semibold text-white">360°</p>
                                <p class="mt-2 text-sm text-emerald-50/70">Land, weather, schemes, and analytics in one place.</p>
                            </div>
                            <div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur-sm">
                                <p class="text-xs font-bold uppercase tracking-[0.22em] text-emerald-100/70">Mission</p>
                                <p class="mt-2 text-3xl font-semibold text-white">Field first</p>
                                <p class="mt-2 text-sm text-emerald-50/70">Built to help teams act faster with less friction.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-6 lg:px-10">
                <div class="w-full max-w-2xl">
                    <div class="auth-card">
                        <div class="mb-8 flex justify-center lg:hidden">
                            <a href="{{ url('/') }}" class="inline-flex">
                                <x-application-logo />
                            </a>
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
