<x-guest-layout>
    <div class="space-y-6">
        <div>
            <span class="section-badge">Email verification</span>
            <h2 class="mt-5 text-4xl font-semibold">Confirm your email address.</h2>
            <p class="mt-3 text-sm leading-7 text-muted">
                Before getting started, verify your email from the link we sent. If it did not arrive, request a new one below.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="status-pill status-success">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-secondary">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
