<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('Live Mandi Prices') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl overflow-hidden shadow-2xl shadow-emerald-500/5">
                <div class="p-8 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-[#0d1310]/50 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Current Market Rates</h3>
                        <p class="text-sm text-gray-500">Prices reflect the average local Mandi rates per Quintal (100kg).</p>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-lg text-sm font-semibold border border-emerald-100 dark:border-emerald-800/50">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                        </span>
                        Live Updates Active
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-[#0d1310] dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-8 py-4 rounded-tl-xl">Commodity</th>
                                <th scope="col" class="px-8 py-4">Price (₹/Qtl)</th>
                                <th scope="col" class="px-8 py-4">Trend</th>
                                <th scope="col" class="px-8 py-4 rounded-tr-xl">24h Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mandiPrices as $data)
                            <tr class="bg-white dark:bg-[#161d19] border-b border-gray-50 dark:border-gray-800/60 hover:bg-gray-50 dark:hover:bg-[#0d1310] transition-colors">
                                <td class="px-8 py-5 font-bold text-gray-900 dark:text-white flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                                        <svg class="w-4 h-4" auto-inserted="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    {{ $data['crop'] }}
                                </td>
                                <td class="px-8 py-5 font-mono text-lg font-semibold text-gray-800 dark:text-gray-200">
                                    ₹{{ number_format($data['price']) }}
                                </td>
                                <td class="px-8 py-5">
                                    @if($data['trend'] === 'up')
                                        <span class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 font-medium bg-emerald-50 dark:bg-emerald-900/20 px-2.5 py-1 rounded-md w-fit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                            Rising
                                        </span>
                                    @elseif($data['trend'] === 'down')
                                        <span class="flex items-center gap-1.5 text-red-500 font-medium bg-red-50 dark:bg-red-900/20 px-2.5 py-1 rounded-md w-fit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                                            Falling
                                        </span>
                                    @else
                                        <span class="flex items-center gap-1.5 text-gray-500 font-medium bg-gray-50 dark:bg-gray-800 px-2.5 py-1 rounded-md w-fit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                            Stable
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 font-medium {{ str_starts_with($data['change'], '+') ? 'text-emerald-600 dark:text-emerald-400' : (str_starts_with($data['change'], '-') ? 'text-red-500' : 'text-gray-500') }}">
                                    {{ $data['change'] }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Market Advice Panel -->
            <div class="mt-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold mb-1">AI Market Insight</h4>
                            <p class="text-indigo-100 max-w-2xl text-sm leading-relaxed">Wheat (Lok-1) and Paddy (Basmati) are showing strong upward momentum ahead of the festive season. If your storage facilities are optimal, withholding sale for 5-7 days may increase profits. Soybean remains stable, excellent for immediate offload.</p>
                        </div>
                    </div>
                    <button class="px-6 py-2.5 bg-white text-indigo-600 font-bold rounded-lg shadow-lg hover:scale-105 transition-transform whitespace-nowrap">
                        Analyze Portfolio
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
