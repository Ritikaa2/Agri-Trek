<x-guest-layout>
    <div class="space-y-6">
        <div>
            <span class="section-badge">Security check</span>
            <h2 class="mt-5 text-4xl font-semibold">Confirm your password.</h2>
            <p class="mt-3 text-sm leading-7 text-muted">
                This protected action requires one extra confirmation before you continue.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <div class="field">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
