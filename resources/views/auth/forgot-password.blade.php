<x-guest-layout>
    <div class="space-y-6">
        <div>
            <span class="section-badge">Password recovery</span>
            <h2 class="mt-5 text-4xl font-semibold">Reset access securely.</h2>
            <p class="mt-3 text-sm leading-7 text-muted">
                Enter your email and we will send the instructions you need to create a new password.
            </p>
        </div>

        <x-auth-session-status class="w-fit" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div class="field">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
