<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Verify OTP & Reset</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('Please enter the 6-digit OTP sent to your email, along with your new password.') }}
        </p>
    </div>

    <!-- Presentation Mode OTP Flash -->
    @if (session('status'))
        <div class="mb-6 font-medium text-sm text-white bg-emerald-500/20 border border-emerald-500/50 rounded-xl p-4 shadow-lg shadow-emerald-500/10">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full opacity-60" type="email" name="email" :value="$email ?? old('email')" required readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Numeric OTP -->
        <div class="mt-6">
            <x-input-label for="otp" :value="__('6-Digit OTP')" />
            <input id="otp" class="block mt-1 w-full bg-gray-900 border-gray-700 dark:text-white rounded-md shadow-sm focus:border-indigo-500 font-mono tracking-[0.5em] text-center text-xl" type="text" name="otp" required autofocus maxlength="6" pattern="\d{6}" placeholder="------" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-8">
            <button class="w-full inline-flex justify-center items-center px-4 py-3 bg-emerald-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-emerald-500 active:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
