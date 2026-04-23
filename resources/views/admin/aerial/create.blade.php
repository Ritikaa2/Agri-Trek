<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('Upload Aerial Dataset') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#161d19] shadow-xl border border-gray-100 dark:border-gray-800 sm:rounded-3xl p-8 sm:p-12">
                
                <div class="mb-8 text-center max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Initialize Trajectory Clustering</h3>
                    <p class="text-gray-500">Upload CSV or JSON files containing drone coordinates to trigger automated analysis and clustering routines.</p>
                </div>

                <form method="POST" action="{{ route('admin.aerial.store') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div>
                        <label for="batch_name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Dataset Batch Label</label>
                        <div class="mt-2">
                            <input type="text" name="batch_name" id="batch_name" required placeholder="e.g. Northern Sector Alpha Scan" class="block w-full rounded-xl border-0 py-3 bg-gray-50 dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 sm:text-sm">
                        </div>
                        <x-input-error :messages="$errors->get('batch_name')" class="mt-2" />
                    </div>

                    <!-- Drag and Drop area styling -->
                    <div>
                        <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200 mb-2">Trajectory Data File (.csv, .json)</label>
                        <div class="mt-2 flex justify-center rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-700 px-6 py-12 hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 transition-colors group">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-300 group-hover:text-emerald-500 transition-colors" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                </svg>
                                <div class="mt-4 flex text-sm leading-6 text-gray-600 dark:text-gray-400 justify-center">
                                    <label for="dataset_file" class="relative cursor-pointer rounded-md bg-transparent font-semibold text-emerald-600 hover:text-emerald-500">
                                        <span>Upload a file</span>
                                        <input id="dataset_file" name="dataset_file" type="file" class="sr-only" required accept=".csv,.json,.txt">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs leading-5 text-gray-500 mt-1">CSV or JSON up to 10MB</p>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('dataset_file')" class="mt-2" />
                    </div>

                    <div class="pt-4 flex flex-col-reverse sm:flex-row justify-center gap-4">
                        <a href="{{ route('dashboard') }}" class="px-8 py-3 rounded-xl font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-center transition-colors">Cancel</a>
                        <button type="submit" class="px-8 py-3 bg-emerald-600 hover:bg-emerald-500 rounded-xl font-semibold text-white shadow-lg shadow-emerald-500/30 transition-transform sm:w-auto hover:-translate-y-0.5">Upload & Analyze</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
