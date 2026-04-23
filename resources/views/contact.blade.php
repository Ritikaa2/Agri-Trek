<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agri-Trek | Contact Us</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-900 text-white min-h-screen flex flex-col selection:bg-emerald-500 selection:text-white">

    <!-- Navbar -->
    <nav class="bg-gray-900/80 backdrop-blur-md shadow-lg border-b border-white/10 w-full z-50 fixed">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="{{ url('/') }}">
                    <x-application-logo />
                </a>

                <div class="hidden md:block">
                    <div class="flex items-center space-x-6">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-200 hover:text-white px-3 py-2 font-medium">Dashboard</a>
                        @else
                            <a href="{{ url('/') }}" class="text-white hover:text-emerald-400 font-medium">Home</a>
                            <a href="{{ route('login') }}" class="text-white hover:text-emerald-400 font-medium">Log in</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center pt-28 pb-12 px-6">
        <div class="w-full max-w-4xl relative">
            <!-- Background effects -->
            <div class="absolute -top-10 -left-10 w-64 h-64 bg-emerald-500/20 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-teal-500/20 rounded-full blur-[80px] pointer-events-none"></div>
            
            <div class="bg-[#111915]/80 backdrop-blur-3xl border border-white/5 rounded-3xl overflow-hidden shadow-2xl relative z-10 grid grid-cols-1 md:grid-cols-2">
                <!-- Info Panel -->
                <div class="p-10 md:p-12 bg-gradient-to-br from-emerald-900/40 to-transparent flex flex-col justify-center">
                    <h1 class="text-4xl font-black text-white mb-4 tracking-tight">Get in touch</h1>
                    <p class="text-emerald-100/70 mb-8 font-medium">Whether you're a farmer needing scheme assistance or an administrator with portal queries, our team is ready to help.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-4 text-gray-300">
                            <div class="w-12 h-12 rounded-full bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20 shadow-inner">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="font-medium tracking-wide">support@agritrek.com</span>
                        </div>
                        <div class="flex items-center gap-4 text-gray-300">
                            <div class="w-12 h-12 rounded-full bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20 shadow-inner">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <span class="font-medium tracking-wide">+91 (800) 123-FARM</span>
                        </div>
                    </div>
                </div>

                <!-- Form Panel -->
                <div class="p-10 md:p-12 border-t md:border-t-0 md:border-l border-white/5 bg-black/20">
                    @if(session('success'))
                        <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-6 py-4 rounded-2xl mb-6 font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-300 mb-1.5">Full Name</label>
                            <input type="text" name="name" id="name" required class="w-full bg-[#161d19] border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-emerald-500 transition-colors">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-300 mb-1.5">Email Address</label>
                            <input type="email" name="email" id="email" required class="w-full bg-[#161d19] border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-emerald-500 transition-colors">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-300 mb-1.5">Your Message</label>
                            <textarea name="message" id="message" rows="4" required class="w-full bg-[#161d19] border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-emerald-500 transition-colors"></textarea>
                        </div>
                        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold rounded-xl transition-all hover:-translate-y-0.5 shadow-lg shadow-emerald-500/20">
                            Send Securely
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-950 border-t border-white/5 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-500 text-sm font-medium">
            © {{ date('Y') }} Agri-Trek Agriculture Platform.
        </div>
    </footer>
</body>
</html>
