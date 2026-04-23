<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
            {{ __('Register Detailed Land Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#161d19] shadow-xl border border-gray-100 dark:border-gray-800 sm:rounded-3xl p-8 sm:p-12 relative overflow-hidden">
                <div class="absolute right-0 top-0 w-64 h-64 bg-emerald-500/5 rounded-bl-full pointer-events-none"></div>

                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Land & Crop Registry</h3>
                    <p class="text-gray-500">Provide accurate details including crop rotations, pesticide selections, and geographic coordinates for trajectory analysis.</p>
                </div>

                <form method="POST" action="{{ route('farmer.lands.store') }}" class="space-y-6 relative z-10">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="area_in_acres" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Total Area (Acres)</label>
                            <div class="mt-2">
                                <input type="number" step="0.01" name="area_in_acres" id="area_in_acres" required class="block w-full rounded-xl border-0 py-3 bg-gray-50 dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 sm:text-sm" value="{{ old('area_in_acres') }}">
                            </div>
                            <x-input-error :messages="$errors->get('area_in_acres')" class="mt-2" />
                        </div>

                        <div>
                            <label for="location_coords" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">GPS Coordinates (Lat,Lng)</label>
                            <div class="mt-2">
                                <input type="text" name="location_coords" id="location_coords" required placeholder="e.g. 23.01, 75.31" class="block w-full rounded-xl border-0 py-3 bg-gray-50 dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 sm:text-sm" value="{{ old('location_coords') }}">
                            </div>
                            <x-input-error :messages="$errors->get('location_coords')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="soil_type" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Soil Type</label>
                            <div class="mt-2">
                                <select name="soil_type" id="soil_type" required class="block w-full rounded-xl border-0 py-3 bg-gray-50 dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 sm:text-sm">
                                    <option value="" disabled selected>Select Soil Base</option>
                                    <option value="Alluvial">Alluvial</option>
                                    <option value="Black">Black Soil</option>
                                    <option value="Red">Red Soil</option>
                                    <option value="Laterite">Laterite</option>
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('soil_type')" class="mt-2" />
                        </div>

                        <div>
                            <label for="crop_type" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Primary Crop</label>
                            <div class="mt-2">
                                <input type="text" name="crop_type" id="crop_type" required placeholder="e.g. Wheat, Rice, Cotton" class="block w-full rounded-xl border-0 py-3 bg-gray-50 dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 sm:text-sm" value="{{ old('crop_type') }}">
                            </div>
                            <x-input-error :messages="$errors->get('crop_type')" class="mt-2" />
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-800 my-8">
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        Crop Management Details
                    </h4>

                    <div>
                        <label for="crops_details" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Specific Crop Details & Rotation Plan</label>
                        <div class="mt-2">
                            <textarea name="crops_details" id="crops_details" rows="2" class="block w-full rounded-xl border-0 py-3 bg-gray-50 dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 sm:text-sm">{{ old('crops_details') }}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('crops_details')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pesticide_usage" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Pesticide Usage (Frequency/Type)</label>
                            <div class="mt-2">
                                <input type="text" name="pesticide_usage" id="pesticide_usage" placeholder="e.g. Glyphosate monthly" class="block w-full rounded-xl border-0 py-3 bg-gray-50 dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 sm:text-sm" value="{{ old('pesticide_usage') }}">
                            </div>
                            <x-input-error :messages="$errors->get('pesticide_usage')" class="mt-2" />
                        </div>

                        <div>
                            <label for="insecticide_usage" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Insecticide Details</label>
                            <div class="mt-2">
                                <input type="text" name="insecticide_usage" id="insecticide_usage" placeholder="e.g. Chlorpyrifos" class="block w-full rounded-xl border-0 py-3 bg-gray-50 dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-600 sm:text-sm" value="{{ old('insecticide_usage') }}">
                            </div>
                            <x-input-error :messages="$errors->get('insecticide_usage')" class="mt-2" />
                        </div>
                    </div>

                    <div class="pt-6 flex flex-col-reverse sm:flex-row justify-end gap-3">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-center transition-colors">Back</a>
                        <button type="submit" class="px-8 py-3 bg-emerald-600 hover:bg-emerald-500 rounded-xl font-semibold text-white shadow-lg shadow-emerald-500/30 transition-transform sm:w-auto hover:-translate-y-0.5">Register Land Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
