<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Land intake</span>
            <div>
                <h1 class="page-title">Register detailed land information</h1>
                <p class="page-subtitle">Capture plot size, location, soil type, crop plan, and treatment history accurately.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container">
        <div class="panel-strong">
            <div class="mb-8">
                <h2 class="text-3xl font-semibold">Land and crop registry</h2>
                <p class="mt-3 text-sm leading-7 text-muted">
                    These details support future insights for weather timing, crop rotation, and aerial analysis.
                </p>
            </div>

            <form method="POST" action="{{ route('farmer.lands.store') }}" class="space-y-6">
                @csrf

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="field">
                        <label for="area_in_acres" class="field-label">Total Area (Acres)</label>
                        <input type="number" step="0.01" name="area_in_acres" id="area_in_acres" required class="field-input" value="{{ old('area_in_acres') }}">
                        <x-input-error :messages="$errors->get('area_in_acres')" class="mt-2" />
                    </div>
                    <div class="field">
                        <label for="location_coords" class="field-label">GPS Coordinates (Lat,Lng)</label>
                        <input type="text" name="location_coords" id="location_coords" required placeholder="23.01, 75.31" class="field-input" value="{{ old('location_coords') }}">
                        <x-input-error :messages="$errors->get('location_coords')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="field">
                        <label for="soil_type" class="field-label">Soil Type</label>
                        <select name="soil_type" id="soil_type" required class="field-select">
                            <option value="" disabled selected>Select soil base</option>
                            <option value="Alluvial">Alluvial</option>
                            <option value="Black">Black Soil</option>
                            <option value="Red">Red Soil</option>
                            <option value="Laterite">Laterite</option>
                        </select>
                        <x-input-error :messages="$errors->get('soil_type')" class="mt-2" />
                    </div>
                    <div class="field">
                        <label for="crop_type" class="field-label">Primary Crop</label>
                        <input type="text" name="crop_type" id="crop_type" required placeholder="Wheat, rice, cotton" class="field-input" value="{{ old('crop_type') }}">
                        <x-input-error :messages="$errors->get('crop_type')" class="mt-2" />
                    </div>
                </div>

                <div class="panel-soft">
                    <p class="eyebrow">Crop management details</p>
                    <p class="mt-2 text-sm leading-7 text-muted">Add supporting context for rotation planning and treatment history.</p>
                </div>

                <div class="field">
                    <label for="crops_details" class="field-label">Specific Crop Details and Rotation Plan</label>
                    <textarea name="crops_details" id="crops_details" rows="3" class="field-textarea">{{ old('crops_details') }}</textarea>
                    <x-input-error :messages="$errors->get('crops_details')" class="mt-2" />
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="field">
                        <label for="pesticide_usage" class="field-label">Pesticide Usage</label>
                        <input type="text" name="pesticide_usage" id="pesticide_usage" placeholder="Glyphosate monthly" class="field-input" value="{{ old('pesticide_usage') }}">
                        <x-input-error :messages="$errors->get('pesticide_usage')" class="mt-2" />
                    </div>
                    <div class="field">
                        <label for="insecticide_usage" class="field-label">Insecticide Details</label>
                        <input type="text" name="insecticide_usage" id="insecticide_usage" placeholder="Chlorpyrifos" class="field-input" value="{{ old('insecticide_usage') }}">
                        <x-input-error :messages="$errors->get('insecticide_usage')" class="mt-2" />
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('dashboard') }}" class="btn-secondary">Back</a>
                    <button type="submit" class="btn-primary">Register Land Data</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
