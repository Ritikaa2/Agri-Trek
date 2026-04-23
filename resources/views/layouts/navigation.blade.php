<nav x-data="{ open: false }" class="bg-white/80 dark:bg-[#0d1310]/80 backdrop-blur-xl border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <x-application-logo />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[1.05rem] font-medium transition-colors">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(auth()->user()->role === 'farmer')
                        <x-nav-link :href="route('farmer.lands.index')" :active="request()->routeIs('farmer.lands.*')" class="text-[1.05rem] font-medium transition-colors">
                            {{ __('My Lands') }}
                        </x-nav-link>
                        <x-nav-link :href="route('farmer.mandi.index')" :active="request()->routeIs('farmer.mandi.*')" class="text-[1.05rem] font-medium transition-colors">
                            {{ __('Mandi Prices') }}
                        </x-nav-link>
                        <x-nav-link :href="route('farmer.weather.index')" :active="request()->routeIs('farmer.weather.*')" class="text-[1.05rem] font-medium transition-colors">
                            {{ __('Weather') }}
                        </x-nav-link>
                        <x-nav-link :href="route('farmer.ai.index')" :active="request()->routeIs('farmer.ai.*')" class="text-[1.05rem] font-medium transition-colors">
                            {{ __('Agronomist AI') }}
                        </x-nav-link>
                        <x-nav-link :href="route('farmer.applications.index')" :active="request()->routeIs('farmer.applications.*')" class="text-[1.05rem] font-medium transition-colors">
                            {{ __('My Applications') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden md:block">
                        <div class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-emerald-600 dark:text-emerald-400 font-bold tracking-wide uppercase">{{ Auth::user()->role ?? 'User' }}</div>
                    </div>
                    
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center justify-center p-0.5 rounded-full bg-white dark:bg-gray-800 hover:ring-2 ring-emerald-500 transition-all cursor-pointer shadow-sm">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff&bold=true" class="w-10 h-10 rounded-full" alt="Avatar">
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-800">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Signed in as</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile Settings') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="text-red-500 focus:text-red-600 hover:text-red-600">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-[#0d1310] border-b border-gray-200 dark:border-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-800">
            <div class="px-4 flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff&bold=true" class="w-10 h-10 rounded-full" alt="Avatar">
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile Settings') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-red-500">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
