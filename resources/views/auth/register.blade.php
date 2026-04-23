<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Create an account</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-emerald-600 hover:text-emerald-500">Sign in instead</a>
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Full Name</label>
            <div class="mt-2">
                <input id="name" name="name" type="text" autocomplete="name" required autofocus class="block w-full rounded-xl border-0 py-2.5 text-gray-900 dark:text-white dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6" value="{{ old('name') }}">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Email address</label>
            <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-xl border-0 py-2.5 text-gray-900 dark:text-white dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6" value="{{ old('email') }}">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Password</label>
                <div class="mt-2">
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="block w-full rounded-xl border-0 py-2.5 text-gray-900 dark:text-white dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Confirm Password</label>
                <div class="mt-2">
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="block w-full rounded-xl border-0 py-2.5 text-gray-900 dark:text-white dark:bg-[#0d1310] shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6">
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
        
        <!-- Role Indicator -->
        <div class="bg-gray-50 dark:bg-emerald-900/10 border border-gray-200 dark:border-emerald-500/20 rounded-xl p-4 flex items-start gap-4">
            <div class="shrink-0 pt-1">
                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-gray-900 dark:text-emerald-400">Farmer Registration</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">You will be registered as a Farmer and gain access to the Farmer Dashboard, land registry, and schemes.</p>
            </div>
        </div>

        <div>
            <button type="submit" class="flex w-full justify-center rounded-xl bg-emerald-600 px-3 py-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-all hover:scale-[1.02]">Create Account</button>
        </div>
    </form>
</x-guest-layout>
