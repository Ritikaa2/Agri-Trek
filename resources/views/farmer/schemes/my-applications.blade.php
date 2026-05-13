<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('My Applications') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-gradient-to-br from-blue-500/20 via-cyan-400/10 to-transparent border border-blue-500/20 rounded-3xl p-8 relative overflow-hidden shadow-lg mb-10">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-blue-500/10 rounded-full blur-[64px] pointer-events-none"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Application Tracking</h3>
                    <p class="text-gray-600 dark:text-gray-400 max-w-3xl text-sm leading-relaxed">
                        Track the status of your government scheme applications here. Our platform automatically syncs with agricultural departments to give you real-time updates on approvals and subvention distributions.
                    </p>
                </div>
            </div>

            @if($applications->isEmpty())
                <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-[2.5rem] p-12 text-center shadow-xl">
                    <div class="w-24 h-24 bg-gray-50 dark:bg-gray-800/50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Applications Yet</h4>
                    <p class="text-gray-500 mb-6">You haven't applied for any government schemes yet.</p>
                    <a href="{{ route('farmer.schemes.index') }}" class="inline-flex px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/30">
                        Browse Available Schemes
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach($applications as $application)
                        <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl p-6 shadow-xl relative overflow-hidden group">
                            
                            <div class="flex flex-col md:flex-row items-center justify-between gap-6 relative z-10">
                                <div class="flex-1">
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ $application->scheme->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Applied on {{ \Carbon\Carbon::parse($application->application_date)->format('F j, Y') }}</p>
                                </div>
                                
                                <div class="shrink-0 flex items-center gap-4">
                                    @if($application->status === 'pending')
                                        <div class="px-4 py-2 bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 font-bold rounded-xl border border-yellow-500/20 flex items-center gap-2">
                                            <span class="flex h-2 w-2 relative">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                                            </span>
                                            Pending Review
                                        </div>
                                    @elseif($application->status === 'approved')
                                        <div class="px-4 py-2 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold rounded-xl border border-emerald-500/20 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Approved
                                        </div>
                                    @elseif($application->status === 'rejected')
                                        <div class="px-4 py-2 bg-red-500/10 text-red-600 dark:text-red-400 font-bold rounded-xl border border-red-500/20 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Rejected
                                        </div>
                                    @endif
                                    
                                    @if($application->scheme->government_link)
                                        <a href="{{ $application->scheme->government_link }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2 bg-blue-500/10 hover:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl transition-colors font-bold text-sm inline-flex items-center gap-2" title="External Govt Website">
                                            Govt Website
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
