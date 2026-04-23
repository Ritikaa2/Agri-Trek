<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 text-yellow-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('Government Schemes') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 px-6 py-4 rounded-2xl mb-6 font-medium shadow-sm flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/30 text-red-600 dark:text-red-400 px-6 py-4 rounded-2xl mb-6 font-medium shadow-sm flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-gradient-to-br from-yellow-500/20 via-orange-400/10 to-transparent border border-yellow-500/20 rounded-3xl p-8 relative overflow-hidden shadow-lg mb-10">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-yellow-500/10 rounded-full blur-[64px] pointer-events-none"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Available Subventions & Grants</h3>
                    <p class="text-gray-600 dark:text-gray-400 max-w-3xl text-sm leading-relaxed">
                        Explore Central and State-level agricultural schemes tailored for you. Based on your KYC and registered land profiles, you are eligible for several grants covering micro-irrigation, subsidies, and high-yield fertilizers.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">
                @foreach($schemes as $scheme)
                    <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-[2.5rem] p-8 shadow-xl hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                        <div class="absolute right-0 top-0 h-full w-48 bg-gradient-to-l from-yellow-500/5 to-transparent pointer-events-none group-hover:from-yellow-500/10 transition-colors"></div>
                        
                        <div class="flex flex-col md:flex-row justify-between gap-8 relative z-10">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="px-4 py-1.5 bg-yellow-500/10 text-yellow-600 dark:text-yellow-500 font-bold rounded-xl text-sm border border-yellow-500/20">Active Scheme</span>
                                    <span class="text-xs text-gray-500 font-medium">Auto-Eligibility: Verified</span>
                                </div>
                                <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $scheme->name }}</h4>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">{{ $scheme->description }}</p>
                                
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-4">
                                        <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold mb-1">Key Benefits</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $scheme->benefits }}</p>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-4">
                                        <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold mb-1">Eligibility</p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $scheme->eligibility_criteria }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="md:w-64 shrink-0 flex flex-col items-end justify-between border-t md:border-t-0 md:border-l border-gray-100 dark:border-gray-800 pt-6 md:pt-0 md:pl-8">
                                <div class="text-right w-full mb-6 max-md:flex max-md:justify-between max-md:items-center">
                                    <p class="text-sm text-gray-500 font-medium mb-1">Application Deadline</p>
                                    <p class="text-lg font-bold text-red-500 dark:text-red-400 bg-red-50 dark:bg-red-500/10 inline-block px-3 py-1 rounded-lg">{{ \Carbon\Carbon::parse($scheme->deadline)->format('F j, Y') }}</p>
                                </div>
                                @if(in_array($scheme->id, $appliedSchemeIds))
                                    <button disabled class="w-full py-4 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold rounded-xl flex items-center justify-center gap-2 cursor-not-allowed border border-emerald-500/20">
                                        Applied
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                @else
                                    <form action="{{ route('farmer.schemes.apply', $scheme) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold rounded-xl transition-all hover:scale-105 shadow-xl flex items-center justify-center gap-2">
                                            Apply Now
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </button>
                                    </form>
                                @endif
                                
                                @if($scheme->government_link)
                                    <a href="{{ $scheme->government_link }}" target="_blank" class="w-full mt-3 py-3 bg-blue-500/10 hover:bg-blue-500/20 text-blue-600 dark:text-blue-400 font-bold rounded-xl transition-all flex items-center justify-center gap-2 text-sm border border-blue-500/20">
                                        Official Portal
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
