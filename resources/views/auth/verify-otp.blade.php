<x-guest-layout>
    <div class="space-y-6">
        <div>
            <span class="section-badge">OTP verification</span>
            <h2 class="mt-5 text-4xl font-semibold">Enter the code we sent.</h2>
            <p class="mt-3 text-sm leading-7 text-muted">
                Confirm the six-digit OTP and set your new password to regain access.
            </p>
        </div>

        @if (session('status'))
            <div class="status-pill status-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <div class="field">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="$email ?? old('email')" required readonly />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="field">
                <x-input-label for="otp" :value="__('6-Digit OTP')" />
                <input id="otp" class="field-input mt-1 text-center text-xl tracking-[0.45em]" type="text" name="otp" required autofocus maxlength="6" pattern="\d{6}" placeholder="------" />
                <x-input-error :messages="$errors->get('otp')" class="mt-2" />
            </div>

            <div class="field">
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="field">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="mt-1 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button class="btn-primary w-full justify-center">
                {{ __('Reset Password') }}
            </button>
        </form>
    </div>
</x-guest-layout>
