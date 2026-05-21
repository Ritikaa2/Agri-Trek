<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Account settings</span>
            <div>
                <h1 class="page-title">Profile management</h1>
                <p class="page-subtitle">Update your account details, change your password, and manage access securely.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container space-y-6">
        <div class="panel">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="panel">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="panel">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
