<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white dark:bg-[#070908]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AgriTrek | Secure Global Network</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style> body { font-family: 'Outfit', sans-serif; } </style>
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 h-full flex selection:bg-emerald-500 selection:text-white">
        
        <!-- Left Side: Image/Branding -->
        <div class="relative hidden w-0 flex-1 lg:block animate-[fade-in-right_1s_ease-out]">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('img/hero_bg.png') }}" alt="Agricultural tech drone background">
            
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 to-emerald-800/40 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-900/90"></div>
            
            <div class="absolute bottom-0 left-0 p-16 z-10 w-full">
                <blockquote class="mt-8">
                    <div class="relative text-lg font-medium text-white/90 md:flex-grow">
                        <svg class="absolute top-0 left-0 transform -translate-x-3 -translate-y-2 h-8 w-8 text-emerald-500/50" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                        <p class="relative z-10 drop-shadow-lg text-2xl font-light leading-snug">"Tracking pesticide applications, optimizing crop yield paths, and monitoring land analytics—all seamlessly connected through Agri-Trek."</p>
                    </div>
                    <footer class="mt-4">
                        <p class="text-base font-semibold text-emerald-400">Global Precision Agriculture Initiative</p>
                    </footer>
                </blockquote>
            </div>
        </div>

        <!-- Right Side: Auth Form -->
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-28 bg-[#fdfdfc] dark:bg-[#161d19]">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <!-- Mobile Logo (hidden on large text) -->
                <div class="flex justify-center mb-10 lg:hidden">
                    <x-application-logo />
                </div>

                {{ $slot }}
            </div>
        </div>

    <style>
        @keyframes fade-in-right {
            0% { opacity: 0; transform: translateX(-20px); }
            100% { opacity: 1; transform: translateX(0); }
        }
    </style>
    </body>
</html>
