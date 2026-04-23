<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('Farmer Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner -->
            <div class="bg-[#111915]/80 backdrop-blur-2xl border border-white/5 rounded-[2.5rem] overflow-hidden shadow-[0_20px_60px_-15px_rgba(16,185,129,0.3)] relative group transition-all duration-500 hover:shadow-[0_30px_80px_-15px_rgba(16,185,129,0.4)]">
                <!-- Abstract glowing backgrounds -->
                <div class="absolute -top-32 -right-32 w-96 h-96 bg-emerald-500/20 rounded-full blur-[80px] pointer-events-none group-hover:bg-emerald-500/30 transition-colors duration-1000"></div>
                <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-teal-600/20 rounded-full blur-[80px] pointer-events-none group-hover:bg-teal-500/30 transition-colors duration-1000"></div>
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>

                <div class="p-8 md:p-12 relative z-10 text-white flex flex-col md:flex-row items-center justify-between gap-8">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-sm font-semibold mb-4 backdrop-blur-md">
                            <svg class="w-4 h-4" auto-inserted="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            Agri-Trek Premium
                        </div>
                        <h3 class="text-4xl md:text-5xl font-black mb-3 tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300">
                            Welcome back, {{ auth()->user()->name }}
                        </h3>
                        <p class="text-emerald-100/70 max-w-xl font-medium text-lg leading-relaxed">
                            You are officially part of Agri-Trek. View your registered land, monitor active government schemes, and manage your crop yields dynamically with AI.
                        </p>
                    </div>
                    <div class="mt-6 md:mt-0 flex-shrink-0 flex flex-col items-center gap-4">
                        <a href="{{ route('farmer.lands.create') }}" class="inline-flex items-center justify-center px-8 py-4 font-bold text-emerald-900 transition-all duration-200 bg-gradient-to-r from-emerald-300 to-emerald-400 rounded-full hover:from-emerald-400 hover:to-emerald-500 hover:shadow-[0_0_40px_rgba(16,185,129,0.4)] hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Register New Land
                        </a>
                        
                        <!-- Scroll Down Dash Indicator -->
                        <div class="hidden md:flex flex-col items-center text-emerald-500/50 mt-2 animate-bounce">
                            <span class="text-xs font-semibold tracking-widest uppercase mb-1">Scroll For More</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile completion nag -->
            @if(!auth()->user()->farmer)
            <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700/50 rounded-2xl p-5 flex flex-col sm:flex-row items-center justify-between" role="alert">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-800 text-yellow-600 dark:text-yellow-400 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <strong class="font-bold text-yellow-800 dark:text-yellow-300">Action Required</strong>
                        <p class="text-yellow-700 dark:text-yellow-400 text-sm mt-1">Please complete your farmer KYC profile (Aadhaar & Address) to apply for government land schemes!</p>
                    </div>
                </div>
                <a href="{{ route('farmer.kyc.create') }}" class="mt-4 sm:mt-0 px-5 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-xl text-sm transition-colors shadow-md shadow-yellow-500/20 whitespace-nowrap inline-block text-center">
                    Complete KYC
                </a>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Nodes -->
                <a href="{{ route('farmer.lands.index') }}" class="block bg-white dark:bg-[#161d19] overflow-hidden shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800 sm:rounded-3xl p-8 hover:-translate-y-1 transition-transform relative group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-emerald-500/5 rounded-bl-full pointer-events-none"></div>
                    <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 mb-6 group-hover:scale-110 transition-transform relative z-10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-lg text-gray-700 dark:text-gray-300 group-hover:text-emerald-500 transition-colors">My Lands Registered</h4>
                    <div class="flex items-end gap-3 mt-2">
                        <p class="text-5xl font-black text-gray-900 dark:text-white">
                            {{ auth()->user()->farmer ? auth()->user()->farmer->lands()->count() : 0 }}
                        </p>
                        <span class="text-sm text-gray-500 font-medium mb-1">Plots</span>
                    </div>
                </a>

                <a href="{{ route('farmer.applications.index') }}" class="block bg-white dark:bg-[#161d19] overflow-hidden shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800 sm:rounded-3xl p-8 hover:-translate-y-1 transition-transform relative group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-blue-500/5 rounded-bl-full pointer-events-none"></div>
                    <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mb-6 group-hover:scale-110 transition-transform relative z-10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-lg text-gray-700 dark:text-gray-300 group-hover:text-blue-500 transition-colors">Active Applications</h4>
                    <div class="flex items-end gap-3 mt-2">
                        <p class="text-5xl font-black text-gray-900 dark:text-white">
                            {{ auth()->user()->farmer ? auth()->user()->farmer->applications()->where('status', 'pending')->count() : 0 }}
                        </p>
                        <span class="text-sm text-gray-500 font-medium mb-1">Pending</span>
                    </div>
                </a>
            </div>

            <!-- Advanced Modules Quick Access -->
            <div class="pt-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Smart Farming Tools</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Weather Card -->
                    <a href="{{ route('farmer.weather.index') }}" class="group relative bg-gradient-to-br from-blue-500 to-cyan-400 rounded-3xl p-6 text-white overflow-hidden shadow-lg shadow-blue-500/30 hover:-translate-y-1 transition-transform">
                        <div class="absolute -right-8 -top-8 opacity-20 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm1-13h-2v6h6v-2h-4V7z"></path></svg>
                        </div>
                        <div class="relative z-10 flex flex-col h-full justify-between gap-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">Agri-Weather</h4>
                                <p class="text-blue-100 text-sm">Detailed forecast for optimal pesticide timing.</p>
                            </div>
                        </div>
                    </a>

                    <!-- Mandi Rates Card -->
                    <a href="{{ route('farmer.mandi.index') }}" class="group relative bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl p-6 overflow-hidden shadow-lg shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition-transform">
                        <div class="absolute -right-8 -top-8 text-emerald-50 dark:text-emerald-900/10 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm.052-13.064c-1.859 0-3.372 1.34-3.372 2.99 0 1.652 1.513 2.992 3.372 2.992 1.458 0 2.709-.824 3.194-2.023h-1.637c-.367.545-.989.877-1.557.877-.927 0-1.681-.663-1.681-1.482 0-.819.754-1.482 1.681-1.482.932 0 1.686.666 1.686 1.482h1.686c0-1.65-1.513-2.99-3.372-2.99zM11 16h2v2h-2z"></path></svg>
                        </div>
                        <div class="relative z-10 flex flex-col h-full justify-between gap-4">
                            <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-bold text-xl text-gray-900 dark:text-white">Live Mandi Prices</h4>
                                    <span class="flex h-2 w-2 relative">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                    </span>
                                </div>
                                <p class="text-gray-500 text-sm">Track real-time commodity rates.</p>
                            </div>
                        </div>
                    </a>

                    <!-- AI Agronomist Card -->
                    <a href="{{ route('farmer.ai.index') }}" class="group relative bg-[#13111c] rounded-3xl p-6 text-white overflow-hidden shadow-lg shadow-purple-500/20 hover:-translate-y-1 transition-transform border border-purple-500/20">
                        <!-- Abstract AI background effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-600/20 to-purple-900/50 group-hover:from-purple-600/30 group-hover:to-purple-900/60 transition-colors"></div>
                        <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-purple-500/30 blur-3xl rounded-full"></div>
                        <div class="relative z-10 flex flex-col h-full justify-between gap-4">
                            <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur-sm border border-white/10">
                                <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1 text-transparent bg-clip-text bg-gradient-to-r from-purple-200 to-fuchsia-200">Agronomist AI</h4>
                                <p class="text-purple-200/70 text-sm">Personalized insights & disease advice.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Aerial Insights Modules Spotlight -->
            <div class="pt-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    Recent Satellite & Drone Insights
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NDVI Card -->
                    <div class="bg-white dark:bg-[#161d19] overflow-hidden rounded-3xl p-6 shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800 relative group">
                        <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-emerald-500/10 to-transparent pointer-events-none"></div>
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-xs font-bold inline-block mb-3 border border-emerald-500/20">Active Analysis</div>
                                <h4 class="font-bold text-xl text-gray-900 dark:text-white mb-2">Crop Vigor (NDVI)</h4>
                                <p class="text-sm text-gray-500 max-w-sm">Satellite data from your primary polygon indicates a 14% increase in crop health over the last 30 days. No immediate fertilization required.</p>
                            </div>
                            <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-2xl flex items-center justify-center p-2 shadow-inner">
                                <!-- Abstract Map SVG -->
                                <svg class="w-full h-full text-emerald-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" opacity="0.3"></path><path d="M12 7c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg>
                            </div>
                        </div>
                        <div class="mt-6 w-full bg-gray-200 dark:bg-gray-800 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full" style="width: 86%"></div>
                        </div>
                        <p class="text-xs text-right mt-2 text-gray-400 font-semibold">86% Optimal Vitality</p>
                    </div>

                    <!-- Water Stress Card -->
                    <div class="bg-white dark:bg-[#161d19] overflow-hidden rounded-3xl p-6 shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800 relative group">
                        <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-blue-500/10 to-transparent pointer-events-none"></div>
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="px-3 py-1 bg-blue-500/10 text-blue-500 rounded-full text-xs font-bold inline-block mb-3 border border-blue-500/20">Alert Issued</div>
                                <h4 class="font-bold text-xl text-gray-900 dark:text-white mb-2">Soil Moisture Matrix</h4>
                                <p class="text-sm text-gray-500 max-w-sm">Recent multi-spectral drone fly-by detected minor water stress in the North-Western quadrant. Suggesting isolated irrigation.</p>
                            </div>
                            <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-2xl flex items-center justify-center p-2 shadow-inner">
                                <svg class="w-full h-full text-blue-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3.25A19.14 19.14 0 005.15 10.3c-2.45 3-.47 7.7 3.32 8.54A7.83 7.83 0 0012 21a7.84 7.84 0 003.53-2.16c3.79-.84 5.77-5.54 3.32-8.54A19.14 19.14 0 0012 3.25z" opacity="0.3"></path><path d="M12 11a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"></path></svg>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between gap-2">
                             <div class="h-2 w-full bg-blue-500 rounded-full opacity-30"></div>
                             <div class="h-2 w-full bg-blue-500 rounded-full opacity-60"></div>
                             <div class="h-2 w-full bg-blue-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(59,130,246,0.6)]"></div>
                             <div class="h-2 w-full bg-gray-300 dark:bg-gray-700 rounded-full"></div>
                        </div>
                        <p class="text-xs text-left mt-2 text-blue-400 font-semibold tracking-wide">STAGE 3 STRESS DETECTED</p>
                    </div>
                </div>
            </div>

            <!-- Government Schemes Spotlight -->
            <div class="pt-6">
                <div class="bg-gradient-to-r from-yellow-500/10 via-orange-500/5 to-transparent border border-yellow-500/20 rounded-3xl p-8 relative overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-yellow-500/10 rounded-full blur-[64px]"></div>
                    <div class="flex flex-col md:flex-row items-center justify-between gap-8 relative z-10">
                        <div>
                            <span class="text-yellow-500 font-bold uppercase tracking-wider text-sm">Opportunities Available</span>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1 mb-3">Government Financial Schemes</h3>
                            <p class="text-gray-600 dark:text-gray-400 max-w-2xl text-sm leading-relaxed">
                                You may be eligible for subventions on solar pumps, automated irrigation frameworks, and high-yield seeds! Agri-Trek integrates with PM KISAN and state-specific agronomy grants. Apply instantly through your digital KYC profile.
                            </p>
                        </div>
                        <div class="shrink-0 flex gap-4">
                            <!-- Link to schemes index -->
                            <a href="{{ route('farmer.schemes.index') }}" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl transition-all hover:scale-105 shadow-lg shadow-yellow-500/30 whitespace-nowrap">
                                Browse Schemes
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support Section inside Dashboard -->
            <div class="pt-8 mb-8">
                <div class="bg-gray-950 border border-gray-800 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden">
                    <div class="absolute -top-32 -right-32 w-96 h-96 bg-emerald-500/10 rounded-full blur-[100px] pointer-events-none"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10">
                        <div>
                            <h3 class="text-3xl font-extrabold text-white mb-4">Farmer Support Direct Line</h3>
                            <p class="text-gray-400 mb-6 font-medium">Are you facing issues with scheme applications, or need expert review on an uploaded drone trajectory? Our agronomists are on standby.</p>
                            
                            <div class="flex items-center gap-4 text-gray-300 bg-white/5 border border-white/10 p-4 rounded-xl mb-4 w-fit">
                                <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="font-medium tracking-wide">support@agritrek.com</span>
                            </div>
                        </div>

                        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-inner">
                            @if(session('success'))
                                <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Message the Support Team</label>
                                    <textarea name="message" id="message" rows="4" required placeholder="Describe your farming issue or software query..." class="w-full bg-[#161d19] border border-gray-800 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-emerald-500 transition-colors placeholder-gray-600"></textarea>
                                </div>
                                <button type="submit" class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition-all hover:-translate-y-0.5 shadow-lg shadow-emerald-500/20 flex justify-center items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                    Submit Ticket
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
