<x-guest-layout>
    <div class="space-y-6">
        <div>
            <span class="section-badge">Farmer onboarding</span>
            <h2 class="mt-5 text-4xl font-semibold">Create your AgriTrek account.</h2>
            <p class="mt-3 text-sm leading-7 text-muted">
                Register once to unlock land records, weather tools, mandi tracking, and scheme applications.
            </p>
        </div>

        <div class="panel-soft">
            <p class="eyebrow">Registration path</p>
            <p class="mt-2 text-sm leading-7 text-muted">
                New users join as farmers and can complete KYC after sign-up to activate scheme and land workflows.
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div class="field">
                <label for="name" class="field-label">Full Name</label>
                <input id="name" name="name" type="text" autocomplete="name" required autofocus class="field-input" value="{{ old('name') }}">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="field">
                <label for="email" class="field-label">Email Address</label>
                <input id="email" name="email" type="email" autocomplete="email" required class="field-input" value="{{ old('email') }}">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="field">
                    <label for="password" class="field-label">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="field-input">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="field">
                    <label for="password_confirmation" class="field-label">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="field-input">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <button type="submit" class="btn-primary">Create Account</button>
                <a href="{{ route('login') }}" class="btn-secondary">Already have an account?</a>
            </div>
        </form>
    </div>
</x-guest-layout>
