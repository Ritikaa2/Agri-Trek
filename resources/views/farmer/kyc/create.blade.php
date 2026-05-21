<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Identity verification</span>
            <div>
                <h1 class="page-title">Complete your KYC profile</h1>
                <p class="page-subtitle">Submit the details required for land registration and government scheme eligibility.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container">
        <div class="panel-strong">
            <div class="mb-8">
                <h2 class="text-3xl font-semibold">Farmer registration details</h2>
                <p class="mt-3 text-sm leading-7 text-muted">
                    Provide your official contact and address details to unlock the rest of the platform.
                </p>
            </div>

            <form method="POST" action="{{ route('farmer.kyc.store') }}" class="space-y-6">
                @csrf

                <div class="field">
                    <label for="aadhaar_no" class="field-label">Aadhaar Number</label>
                    <input id="aadhaar_no" name="aadhaar_no" type="text" maxlength="12" pattern="\d{12}" title="12 digit Aadhaar number" required class="field-input" value="{{ old('aadhaar_no') }}" placeholder="123412341234">
                    <x-input-error :messages="$errors->get('aadhaar_no')" class="mt-2" />
                </div>

                <div class="field">
                    <label for="phone" class="field-label">Phone Number</label>
                    <input id="phone" name="phone" type="tel" required class="field-input" value="{{ old('phone') }}" placeholder="+91 9876543210">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="field">
                    <label for="address" class="field-label">Full Address</label>
                    <textarea id="address" name="address" rows="4" required class="field-textarea">{{ old('address') }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="field">
                        <label for="village" class="field-label">Village</label>
                        <input id="village" name="village" type="text" required class="field-input" value="{{ old('village') }}">
                        <x-input-error :messages="$errors->get('village')" class="mt-2" />
                    </div>
                    <div class="field">
                        <label for="district" class="field-label">District</label>
                        <input id="district" name="district" type="text" required class="field-input" value="{{ old('district') }}">
                        <x-input-error :messages="$errors->get('district')" class="mt-2" />
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('dashboard') }}" class="btn-secondary">Cancel</a>
                    <button type="submit" class="btn-primary">Submit KYC</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
