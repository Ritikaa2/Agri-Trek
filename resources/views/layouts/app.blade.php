<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AgriTrek | Field Operations</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-slate-900 antialiased">
        <div class="relative min-h-screen overflow-x-hidden pb-10">
            @include('layouts.navigation')

            @isset($header)
                <header class="relative z-10 pt-8">
                    <div class="shell-container">
                        <div class="page-hero">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <main class="relative z-10 pt-8">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
