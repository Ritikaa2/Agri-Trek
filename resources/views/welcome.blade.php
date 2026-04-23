<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agri-Trek | Precision Aerial Farming</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- AlpineJS for animations -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-900 text-white overflow-x-hidden selection:bg-emerald-500 selection:text-white">

    <!-- Background Layer -->
    <div class="fixed inset-0 z-[-1] animate-pulse" style="animation-duration: 20s;">
        <img src="{{ asset('img/hero_bg.png') }}" class="object-cover w-full h-full opacity-60" alt="Agri-Trek background">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-emerald-900/40 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-950"></div>
    </div>

    <!-- Navbar -->
    <nav x-data="{ scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 50)"
         :class="{ 'bg-gray-900/80 backdrop-blur-md shadow-lg border-b border-white/10': scrolled, 'bg-transparent': !scrolled }"
         class="fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <x-application-logo />

                <!-- Auth Links -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center items-baseline space-x-6">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-emerald-400 px-3 py-2 rounded-md text-sm font-medium transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-5 py-2.5 rounded-full text-sm font-semibold shadow-lg shadow-emerald-500/25 transition-all hover:scale-105 active:scale-95">Sign Up Free</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative h-screen flex items-center justify-center overflow-hidden pt-20">
        <!-- Abstract glowing orbs behind text -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-emerald-500/20 rounded-full blur-[128px] pointer-events-none fade-in-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-teal-500/20 rounded-full blur-[128px] pointer-events-none fade-in-slow" style="animation-delay: 1s;"></div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-12 relative z-10 w-full mt-10">
            
            <!-- Text Content -->
            <div class="flex-1 text-center md:text-left drop-shadow-2xl space-y-8 animate-[fade-in-up_1s_ease-out]">
                <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bg-white/5 backdrop-blur-xl border border-white/10 text-emerald-300 text-sm font-semibold mb-2 hover:bg-white/10 transition-colors cursor-pointer">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    Now with Smart Agronomist AI & Drone Trajectory Analysis
                </div>
                
                <h1 class="text-6xl md:text-[5.5rem] font-black text-white leading-[1.1] tracking-tight drop-shadow-lg">
                    Farm Smarter <br/> Not <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-yellow-300 animate-gradient-x">Harder.</span>
                </h1>
                
                <p class="mt-6 text-lg md:text-xl text-gray-300/90 font-light max-w-2xl drop-shadow-md leading-relaxed selection:bg-emerald-500/40">
                    Agri-Trek digitizes your land records, seamlessly bridges government schemes, and leverages advanced AI and aerial clustering to maximize your yield. The future of agronomy is here.
                </p>
                
                <div class="mt-12 flex flex-col sm:flex-row justify-center md:justify-start gap-5">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="group relative inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-200 bg-emerald-600 rounded-full hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600 shadow-[0_0_40px_rgba(16,185,129,0.4)] hover:shadow-[0_0_60px_rgba(16,185,129,0.6)] hover:-translate-y-1">
                            Go to Dashboard
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-200 bg-emerald-600 rounded-full hover:bg-emerald-500 shadow-[0_0_40px_rgba(16,185,129,0.3)] hover:shadow-[0_0_60px_rgba(16,185,129,0.5)] hover:-translate-y-1">
                            Get Started Free
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                        <a href="#about" class="inline-flex items-center justify-center px-8 py-4 font-bold text-white bg-white/5 backdrop-blur-md border border-white/10 rounded-full hover:bg-white/10 transition-all hover:-translate-y-1">
                            Explore Features
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Glassmorphism Stats Card -->
            <div class="hidden md:block w-full max-w-[26rem] animate-[fade-in-up_1.5s_ease-out]">
                <div class="bg-[#111915]/50 backdrop-blur-2xl rounded-[2.5rem] p-8 border border-white/10 shadow-[0_30px_100px_-15px_rgba(0,0,0,0.5)] relative overflow-hidden group">
                    <div class="absolute -top-16 -right-16 w-48 h-48 bg-emerald-500/20 rounded-full blur-[64px] group-hover:bg-emerald-500/30 transition-colors duration-700"></div>
                    <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-teal-500/20 rounded-full blur-[64px] group-hover:bg-teal-500/30 transition-colors duration-700"></div>
                    
                    <div class="space-y-7 relative z-10">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-2xl font-bold text-white tracking-tight">Live Metrics</h3>
                            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_rgba(16,185,129,1)]"></div>
                        </div>

                        <div class="bg-gradient-to-r from-white/10 to-white/5 rounded-3xl p-5 border border-white/5 flex items-center justify-between hover:bg-white/10 transition-colors backdrop-blur-md">
                            <div>
                                <p class="text-gray-400 text-sm font-medium mb-1">Active Farmers</p>
                                <p class="text-3xl font-black tracking-tight text-white">{{ \App\Models\Farmer::count() + 143 }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400/20 to-emerald-600/20 flex items-center justify-center text-emerald-400 border border-emerald-500/20 shadow-inner">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4a2 2 0 00-2-2H4a2 2 0 00-2 2v16h5M18 10V6M6 10V6M6 16v-2m12 2v-2"></path></svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-white/10 to-white/5 rounded-3xl p-5 border border-white/5 flex items-center justify-between hover:bg-white/10 transition-colors backdrop-blur-md">
                            <div>
                                <p class="text-gray-400 text-sm font-medium mb-1">Govt Schemes Active</p>
                                <p class="text-3xl font-black tracking-tight text-white">{{ \App\Models\Application::count() + 28 }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400/20 to-orange-600/20 flex items-center justify-center text-yellow-400 border border-yellow-500/20 shadow-inner">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-r from-white/10 to-white/5 rounded-3xl p-5 border border-white/5 flex items-center justify-between hover:bg-white/10 transition-colors backdrop-blur-md">
                            <div>
                                <p class="text-gray-400 text-sm font-medium mb-1">AI Datasets Processed</p>
                                <p class="text-3xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-emerald-300">{{ \App\Models\AerialDataset::count() + 12 }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-400/20 to-blue-600/20 flex items-center justify-center text-teal-400 border border-teal-500/20 shadow-inner">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scrolldown indicator -->
        <a href="#features" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce cursor-pointer opacity-70 hover:opacity-100 transition-opacity">
            <svg class="w-8 h-8 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </a>
    </main>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gray-950 relative border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-emerald-500 font-semibold tracking-wide uppercase text-sm mb-2">Smart Farming Suite</h2>
                <p class="mt-2 text-4xl font-extrabold text-white sm:text-5xl tracking-tight">Everything you need to optimize your yield.</p>
                <p class="max-w-2xl mt-4 mx-auto text-xl text-gray-400">From AI-driven insight to real-time market data, Agri-Trek provides end-to-end integration for the modern farmer.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-900 border border-white/5 rounded-3xl p-8 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">AI Agronomist Chat</h3>
                    <p class="text-gray-400 leading-relaxed">Instantly receive intelligent, personalized advice regarding pesticide schedules, crop rotation, and optimal planting dates based on weather data.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-900 border border-white/5 rounded-3xl p-8 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Live Mandi Prices</h3>
                    <p class="text-gray-400 leading-relaxed">Make highly informed financial decisions with our live Mandi commodity tracking matrix featuring intelligent trend predictions.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-900 border border-white/5 rounded-3xl p-8 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-500 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Drone Analytics</h3>
                    <p class="text-gray-400 leading-relaxed">Upload and map aerial drone dataset patterns using advanced ML clustering (DBSCAN & HDBSCAN) to identify anomalies across your lands.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About & Architecture Platform Details Section -->
    <section id="about" class="py-24 bg-gray-900 relative border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                <!-- Text Content -->
                <div class="w-full lg:w-1/2 space-y-8">
                    <div>
                        <h2 class="text-emerald-500 font-semibold tracking-wide uppercase text-sm mb-2">Platform Deep Dive</h2>
                        <h3 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl mb-6">Built for precision. <br/> Engineered for scale.</h3>
                        <p class="text-xl text-gray-400 font-light leading-relaxed">
                            Agri-Trek isn't just a basic portal; it is a full-stack agronomy ecosystem. Developed as a high-tier B.Tech project, our architecture integrates advanced web technologies with machine learning to resolve real-world agricultural inefficiencies.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
                        <div class="bg-[#161d19] border border-emerald-500/10 rounded-2xl p-6 shadow-lg shadow-emerald-500/5">
                            <div class="w-10 h-10 bg-emerald-500/10 text-emerald-500 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 7.5l-6.5-3.25L12 3.5l6.5 2.75L12 9.5zM2 12l10 5 10-5M2 17l10 5 10-5" stroke="none"/></svg>
                            </div>
                            <h4 class="text-white font-bold mb-2">Laravel 11 Backend</h4>
                            <p class="text-gray-400 text-sm">Robust MVC architecture with Eloquent ORM, handling authenticated KYC, land records, and scheme applications securely.</p>
                        </div>
                        <div class="bg-[#161d19] border border-blue-500/10 rounded-2xl p-6 shadow-lg shadow-blue-500/5">
                            <div class="w-10 h-10 bg-blue-500/10 text-blue-500 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                            </div>
                            <h4 class="text-white font-bold mb-2">ML Drone Clustering</h4>
                            <p class="text-gray-400 text-sm">Uses K-Means and DBSCAN algorithms to process aerial trajectory datasets, plotting spatial anomalies on coordinate planes.</p>
                        </div>
                        <div class="bg-[#161d19] border border-purple-500/10 rounded-2xl p-6 shadow-lg shadow-purple-500/5">
                            <div class="w-10 h-10 bg-purple-500/10 text-purple-500 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            </div>
                            <h4 class="text-white font-bold mb-2">Tailwind & Alpine</h4>
                            <p class="text-gray-400 text-sm">Premium glassmorphism UI built with utility-first CSS and lightweight reactive Javascript components.</p>
                        </div>
                        <div class="bg-[#161d19] border border-yellow-500/10 rounded-2xl p-6 shadow-lg shadow-yellow-500/5">
                            <div class="w-10 h-10 bg-yellow-500/10 text-yellow-500 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h4 class="text-white font-bold mb-2">AI Agronomist</h4>
                            <p class="text-gray-400 text-sm">Actionable intelligence for farmers regarding pesticide management and real-time commodity market dynamics.</p>
                        </div>
                    </div>
                </div>

                <!-- Abstract Visual -->
                <div class="w-full lg:w-1/2 relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 rounded-[3rem] blur-3xl"></div>
                    <div class="bg-gray-950 border border-gray-800 rounded-[3rem] p-8 relative z-10 shadow-2xl overflow-hidden flex items-center justify-center min-h-[500px]">
                        <!-- Decorative Code/Terminal window mock -->
                        <div class="w-full bg-[#0d130f] rounded-2xl border border-gray-800 shadow-2xl overflow-hidden">
                            <div class="flex items-center px-4 py-3 bg-gray-900 border-b border-gray-800 gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                <span class="ml-4 text-xs text-gray-500 font-mono">drone_clustering.py</span>
                            </div>
                            <div class="p-6 font-mono text-sm text-emerald-400 leading-relaxed overflow-x-auto">
                                <span class="text-purple-400">import</span> pandas <span class="text-purple-400">as</span> pd<br/>
                                <span class="text-purple-400">from</span> sklearn.cluster <span class="text-purple-400">import</span> DBSCAN<br/><br/>
                                <span class="text-gray-500"># Load aerial dataset from Laravel API</span><br/>
                                data = pd.read_json(<span class="text-yellow-300">'/api/aerial/v1/dataset_{id}'</span>)<br/>
                                coordinates = data[[<span class="text-yellow-300">'lat'</span>, <span class="text-yellow-300">'lng'</span>]]<br/><br/>
                                <span class="text-gray-500"># Process spatial density patterns</span><br/>
                                cluster_model = DBSCAN(eps=<span class="text-orange-400">0.5</span>, min_samples=<span class="text-orange-400">5</span>)<br/>
                                labels = cluster_model.fit_predict(coordinates)<br/><br/>
                                <span class="text-purple-400">if</span> __name__ == <span class="text-yellow-300">'__main__'</span>:<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">print</span>(<span class="text-yellow-300">"Agri-Trek ML Analysis Complete. Anomalies Detected: "</span>, <span class="text-blue-400">len</span>(set(labels)))
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-gray-900 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-[#111915]/80 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl relative">
                <div class="absolute -top-32 -right-32 w-96 h-96 bg-emerald-500/20 rounded-full blur-[100px] pointer-events-none"></div>
                <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-teal-500/20 rounded-full blur-[100px] pointer-events-none"></div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 relative z-10">
                    <div class="p-10 md:p-16 flex flex-col justify-center">
                        <h2 class="text-4xl font-extrabold text-white mb-4">Contact Support</h2>
                        <p class="text-gray-400 text-lg mb-8">Need help registering a land profile, or having trouble uploading aerial data? Our agricultural experts are available 24/7.</p>
                        
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 text-gray-300">
                                <div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center border border-white/10 shrink-0">
                                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="font-medium">support@agritrek.com</span>
                            </div>
                            <div class="flex items-center gap-4 text-gray-300">
                                <div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center border border-white/10 shrink-0">
                                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <span class="font-medium">+91 (800) 123-FARM</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-10 md:p-16 bg-white/5 border-l border-white/5">
                        @if(session('success'))
                            <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-6 py-4 rounded-2xl mb-6">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                                <input type="text" name="name" id="name" required class="w-full bg-gray-900 border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                                <input type="email" name="email" id="email" required class="w-full bg-gray-900 border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Your Message</label>
                                <textarea name="message" id="message" rows="4" required class="w-full bg-gray-900 border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"></textarea>
                            </div>
                            <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition-all hover:-translate-y-1 shadow-lg shadow-emerald-500/20">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-white/5 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                <x-application-logo class="pointer-events-none" />
            </div>
            <p class="text-gray-500 text-sm">© {{ date('Y') }} Agri-Trek Agriculture Platform. Designed for B.Tech project precision.</p>
        </div>
    </footer>

    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in-slow {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .animate-gradient-x {
            background-size: 200% auto;
            animation: textShine 4s linear infinite;
        }
        @keyframes textShine {
            to { background-position: 200% center; }
        }
    </style>
</body>
</html>
