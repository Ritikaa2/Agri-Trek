<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('Agri-Weather Forecast') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(isset($weatherData['alerts'][0]))
            <div class="bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-400 p-6 rounded-r-2xl shadow-sm flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-yellow-800 dark:text-yellow-300">Weather Alert & Advisory</h3>
                    <p class="mt-1 text-yellow-700 dark:text-yellow-400 text-sm">
                        {{ $weatherData['alerts'][0] }}
                    </p>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Current Weather -->
                <div class="lg:col-span-1 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute -top-12 -right-12 text-white/20">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm1-13h-2v6h6v-2h-4V7z"></path></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <p class="text-blue-50 uppercase font-semibold tracking-wider text-sm mb-4">Current Conditions</p>
                        <div class="flex items-center gap-4">
                            <span class="text-7xl font-black">{{ $weatherData['current']['temp'] }}°</span>
                            <div class="flex flex-col">
                                <span class="text-xl font-medium">{{ $weatherData['current']['condition'] }}</span>
                                <span class="text-blue-100">Feels like {{ $weatherData['current']['temp'] + 2 }}°</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 grid grid-cols-2 gap-4 mt-12 pt-6 border-t border-blue-400/50">
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Humidity</p>
                            <p class="font-semibold text-lg flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                {{ $weatherData['current']['humidity'] }}%
                            </p>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Wind</p>
                            <p class="font-semibold text-lg flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                {{ $weatherData['current']['wind'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 5 Day Forecast -->
                <div class="lg:col-span-2 bg-white dark:bg-[#161d19] rounded-3xl p-8 border border-gray-100 dark:border-gray-800 shadow-xl shadow-gray-200/40 dark:shadow-none">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">5-Day Agricultural Forecast</h3>
                    
                    <div class="flex flex-col gap-4">
                        @foreach($weatherData['forecast'] as $day)
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 dark:bg-[#0d1310] hover:bg-emerald-50 dark:hover:bg-emerald-900/10 transition-colors border border-transparent hover:border-emerald-100 dark:hover:border-emerald-900/30 group">
                                <div class="flex items-center gap-6 w-1/3">
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $day['day'] }}</p>
                                </div>
                                <div class="flex items-center gap-3 w-1/3">
                                    @if(str_contains(strtolower($day['condition']), 'rain') || str_contains(strtolower($day['condition']), 'storm'))
                                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-500 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        </div>
                                    @endif
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $day['condition'] }}</span>
                                </div>
                                <div class="w-1/3 text-right">
                                    <span class="font-bold text-xl text-gray-900 dark:text-white">{{ $day['temp'] }}°<span class="text-gray-400 text-sm font-medium">C</span></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
