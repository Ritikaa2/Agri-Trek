<section class="space-y-6">
    <header>
        <h2 class="text-3xl font-semibold">Delete account</h2>
        <p class="mt-3 text-sm leading-7 text-muted">
            This permanently removes your account and associated data. Continue only if you are certain.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-5 p-1">
            @csrf
            @method('delete')

            <div>
                <h2 class="text-3xl font-semibold">Delete this account?</h2>
                <p class="mt-3 text-sm leading-7 text-muted">
                    Once deleted, all related resources and records are removed permanently. Enter your password to confirm.
                </p>
            </div>

            <div class="field">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
