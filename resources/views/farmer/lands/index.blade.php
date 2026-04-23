<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('My Lands & Crops Portfolio') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-end mb-8 px-4 sm:px-0">
                <div>
                    <h3 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-400 dark:to-teal-300">Registered Lands</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Manage your detailed agronomy profiles including pesticides, soil types, and crop rotations.</p>
                </div>
                <div>
                    <a href="{{ route('farmer.lands.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-500 transition-colors shadow-lg shadow-emerald-500/30 text-white font-semibold rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add Land Profile
                    </a>
                </div>
            </div>

            @if($lands->isEmpty())
                <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl p-16 text-center shadow-xl shadow-gray-200/40 dark:shadow-none">
                    <div class="w-24 h-24 mx-auto bg-gray-50 dark:bg-[#0d1310] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Land Profiles Found</h4>
                    <p class="text-gray-500 max-w-md mx-auto mb-8">You haven't registered any land details yet. Add your land, crop, and pesticide profiles to unlock AI-driven insights.</p>
                    <a href="{{ route('farmer.lands.create') }}" class="px-8 py-3 bg-gray-900 dark:bg-emerald-600 hover:bg-gray-800 dark:hover:bg-emerald-500 text-white font-medium rounded-xl transition-colors">Start Registration</a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($lands as $index => $land)
                        <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl overflow-hidden hover:-translate-y-2 transition-transform duration-300 shadow-xl shadow-emerald-500/5 group">
                            <!-- Header Gradient -->
                            <div class="h-3 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
                            
                            <div class="p-6 sm:p-8">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                            <span class="font-bold text-xl">{{ $index + 1 }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 dark:text-white text-lg">Plot #{{ $land->id }}</h4>
                                            <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400">{{ $land->area_in_acres }} Acres</p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-[#0d1310] text-gray-800 dark:text-gray-300">
                                        {{ $land->soil_type }} Soil
                                    </span>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-[#0d1310] border border-gray-100 dark:border-gray-800/50">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Primary Crop</span>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $land->crop_type ?: 'Not Set' }}</span>
                                    </div>

                                    @if($land->crops_details)
                                        <div class="text-sm">
                                            <p class="text-gray-500 font-medium mb-1">Rotation / Details</p>
                                            <p class="text-gray-800 dark:text-gray-300 bg-gray-50 dark:bg-[#0d1310] p-3 rounded-xl">{{ Str::limit($land->crops_details, 60) }}</p>
                                        </div>
                                    @endif

                                    <div class="grid grid-cols-2 gap-3 mt-4">
                                        <div class="p-3 rounded-xl border border-red-100 dark:border-red-900/30 bg-red-50/50 dark:bg-red-900/10">
                                            <p class="text-xs font-semibold text-red-500 uppercase tracking-wider mb-1">Pesticides</p>
                                            <p class="text-sm font-medium text-gray-800 dark:text-gray-300 truncate" title="{{ $land->pesticide_usage }}">{{ $land->pesticide_usage ?: 'None' }}</p>
                                        </div>
                                        <div class="p-3 rounded-xl border border-purple-100 dark:border-purple-900/30 bg-purple-50/50 dark:bg-purple-900/10">
                                            <p class="text-xs font-semibold text-purple-500 uppercase tracking-wider mb-1">Insecticides</p>
                                            <p class="text-sm font-medium text-gray-800 dark:text-gray-300 truncate" title="{{ $land->insecticide_usage }}">{{ $land->insecticide_usage ?: 'None' }}</p>
                                        </div>
                                    </div>

                                    <div class="pt-4 flex items-center justify-between border-t border-gray-100 dark:border-gray-800 mt-4">
                                        <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $land->location_coords }}
                                        </div>
                                        <span class="text-xs text-gray-400">Registered: {{ $land->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
