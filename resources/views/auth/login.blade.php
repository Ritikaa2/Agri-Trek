<x-guest-layout>
    <div class="space-y-6">
        <div>
            <span class="section-badge">Secure sign in</span>
            <h2 class="mt-5 text-4xl font-semibold">Welcome back.</h2>
            <p class="mt-3 text-sm leading-7 text-muted">
                Sign in to access your field workspace, market insights, and scheme activity.
            </p>
        </div>

        <x-auth-session-status class="w-fit" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div class="field">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="field">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <label for="remember_me" class="inline-flex items-center gap-3 text-sm font-medium text-muted">
                    <input id="remember_me" type="checkbox" class="rounded-full border-[color:var(--line-strong)] text-[color:var(--accent)] focus:ring-[rgba(45,124,75,0.2)]" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-accent transition hover:opacity-80" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
                <a href="{{ route('register') }}" class="btn-secondary">Create Farmer Account</a>
            </div>
        </form>
    </div>
</x-guest-layout>
