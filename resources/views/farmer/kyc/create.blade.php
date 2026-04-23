<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
            {{ __('Complete Your KYC Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#161d19] overflow-hidden shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800 sm:rounded-3xl p-8 sm:p-12 relative group">
                <div class="absolute right-0 top-0 w-64 h-64 bg-emerald-500/5 rounded-bl-full pointer-events-none"></div>
                
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Farmer Registration Details</h3>
                    <p class="text-gray-500">Please provide your official details to enable land registration and government scheme applications.</p>
                </div>

                <form method="POST" action="{{ route('farmer.kyc.store') }}" class="space-y-6 relative z-10">
                    @csrf

                    <div>
                        <label for="aadhaar_no" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Aadhaar Number</label>
                        <div class="mt-2">
                            <input id="aadhaar_no" name="aadhaar_no" type="text" maxlength="12" pattern="\d{12}" title="12 digit Aadhaar number" required class="block w-full rounded-xl border-0 py-3 text-gray-900 dark:text-white dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6" value="{{ old('aadhaar_no') }}" placeholder="123412341234">
                        </div>
                        <x-input-error :messages="$errors->get('aadhaar_no')" class="mt-2" />
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Phone Number</label>
                        <div class="mt-2">
                            <input id="phone" name="phone" type="tel" required class="block w-full rounded-xl border-0 py-3 text-gray-900 dark:text-white dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6" value="{{ old('phone') }}" placeholder="+91 9876543210">
                        </div>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Full Address</label>
                        <div class="mt-2">
                            <textarea id="address" name="address" rows="3" required class="block w-full rounded-xl border-0 py-3 text-gray-900 dark:text-white dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6">{{ old('address') }}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="village" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Village</label>
                            <div class="mt-2">
                                <input id="village" name="village" type="text" required class="block w-full rounded-xl border-0 py-3 text-gray-900 dark:text-white dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6" value="{{ old('village') }}">
                            </div>
                            <x-input-error :messages="$errors->get('village')" class="mt-2" />
                        </div>

                        <div>
                            <label for="district" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">District</label>
                            <div class="mt-2">
                                <input id="district" name="district" type="text" required class="block w-full rounded-xl border-0 py-3 text-gray-900 dark:text-white dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6" value="{{ old('district') }}">
                            </div>
                            <x-input-error :messages="$errors->get('district')" class="mt-2" />
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end gap-3">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">Cancel</a>
                        <button type="submit" class="px-8 py-3 bg-emerald-600 hover:bg-emerald-500 rounded-xl font-semibold text-white shadow-lg shadow-emerald-500/30 transition-transform hover:-translate-y-0.5">Submit KYC</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
