<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('Admin Command Center') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-500 rounded-3xl overflow-hidden shadow-2xl shadow-emerald-500/20 relative">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20"></div>
                <div class="p-8 md:p-12 relative z-10 text-white">
                    <h3 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h3>
                    <p class="text-emerald-50 max-w-2xl font-light text-lg">You have pending scheme applications to review and new aerial datasets uploaded. Ensure compliance and monitor precision clustering insights.</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat 1 -->
                <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl p-6 shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition-transform group">
                    <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4a2 2 0 00-2-2H4a2 2 0 00-2 2v16h5z"></path></svg>
                    </div>
                    <h4 class="text-gray-500 dark:text-gray-400 font-medium">Registered Farmers</h4>
                    <p class="text-4xl font-black text-gray-800 dark:text-white mt-1">{{ \App\Models\Farmer::count() }}</p>
                </div>
                
                <!-- Stat 2 -->
                <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl p-6 shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition-transform group">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-gray-500 dark:text-gray-400 font-medium">Total Land Apps</h4>
                    <p class="text-4xl font-black text-gray-800 dark:text-white mt-1">{{ \App\Models\Application::count() }}</p>
                </div>

                <!-- Stat 3 -->
                <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl p-6 shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition-transform group">
                    <div class="w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-500 mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-gray-500 dark:text-gray-400 font-medium">Active Schemes</h4>
                    <p class="text-4xl font-black text-gray-800 dark:text-white mt-1">{{ \App\Models\Scheme::count() }}</p>
                </div>

                <!-- Stat 4 -->
                <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl p-6 shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition-transform group">
                    <div class="w-12 h-12 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-500 mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                    </div>
                    <h4 class="text-gray-500 dark:text-gray-400 font-medium">Aerial Clusters</h4>
                    <p class="text-4xl font-black text-gray-800 dark:text-white mt-1">{{ \App\Models\Cluster::count() }}</p>
                </div>
            </div>

            <!-- Main Interactive Component -->
            <div class="bg-white dark:bg-[#161d19] border border-gray-100 dark:border-gray-800 rounded-3xl p-8 shadow-xl shadow-gray-200/50 dark:shadow-none">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 pb-4 border-b border-gray-100 dark:border-gray-800">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Quick Command Modules</h3>
                    <div class="mt-4 md:mt-0 flex gap-3">
                        <a href="{{ route('admin.users.index') }}" class="px-5 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200 font-medium text-sm transition-colors text-center inline-block">Manage Users</a>
                        <a href="{{ route('admin.aerial.create') }}" class="px-5 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-medium text-sm shadow-lg shadow-emerald-500/25 transition-colors text-center inline-block">Upload Aerial Data</a>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 dark:bg-[#0d1310] border border-dashed border-gray-200 dark:border-gray-800 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-200 dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4 animate-bounce">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-700 dark:text-gray-300">No Analytics Rendered Yet</h4>
                    <p class="text-gray-500 mt-2 max-w-md mx-auto">Upload drone trajectory data (.csv or .json) via the Aerial Datasets module to automatically generate map clusters and heatmaps.</p>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
