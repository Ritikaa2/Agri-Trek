@php
    $links = [
        ['label' => 'Dashboard', 'route' => route('dashboard'), 'active' => request()->routeIs('dashboard')],
    ];

    if (auth()->user()->role === 'farmer') {
        $links = array_merge($links, [
            ['label' => 'Lands', 'route' => route('farmer.lands.index'), 'active' => request()->routeIs('farmer.lands.*')],
            ['label' => 'Mandi', 'route' => route('farmer.mandi.index'), 'active' => request()->routeIs('farmer.mandi.*')],
            ['label' => 'Weather', 'route' => route('farmer.weather.index'), 'active' => request()->routeIs('farmer.weather.*')],
            ['label' => 'Agronomist AI', 'route' => route('farmer.ai.index'), 'active' => request()->routeIs('farmer.ai.*')],
            ['label' => 'Applications', 'route' => route('farmer.applications.index'), 'active' => request()->routeIs('farmer.applications.*')],
        ]);
    }

    if (auth()->user()->role === 'admin') {
        $links = array_merge($links, [
            ['label' => 'Users', 'route' => route('admin.users.index'), 'active' => request()->routeIs('admin.users.*')],
            ['label' => 'Aerial Upload', 'route' => route('admin.aerial.create'), 'active' => request()->routeIs('admin.aerial.*')],
        ]);
    }
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-[color:var(--line)] bg-[rgba(248,244,236,0.82)] backdrop-blur-xl">
    <div class="shell-container">
        <div class="flex min-h-[5.5rem] items-center justify-between gap-6 py-4">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="inline-flex shrink-0">
                    <x-application-logo />
                </a>

                <div class="hidden flex-wrap items-center gap-2 lg:flex">
                    @foreach($links as $link)
                        <x-nav-link :href="$link['route']" :active="$link['active']">
                            {{ $link['label'] }}
                        </x-nav-link>
                    @endforeach
                </div>
            </div>

            <div class="hidden items-center gap-4 sm:flex">
                <div class="text-right">
                    <p class="text-sm font-bold text-[color:var(--ink)]">{{ Auth::user()->name }}</p>
                    <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-[color:var(--muted)]">
                        {{ Auth::user()->role ?? 'User' }}
                    </p>
                </div>

                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 rounded-full border border-[color:var(--line)] bg-[rgba(255,252,246,0.9)] px-2 py-2 shadow-sm transition hover:border-[rgba(45,124,75,0.24)] hover:shadow-md">
                            <img
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2d7c4b&color=fff&bold=true"
                                class="h-10 w-10 rounded-full border border-white/70"
                                alt="Avatar"
                            >
                            <span class="hidden pr-2 text-sm font-semibold text-[color:var(--ink)] md:block">Open menu</span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border-b border-[color:var(--line)] px-4 py-4">
                            <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-[color:var(--muted)]">Signed in as</p>
                            <p class="mt-1 text-sm font-semibold text-[color:var(--ink)]">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">Profile Settings</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-[color:var(--danger)]"
                            >
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <button
                @click="open = ! open"
                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-[color:var(--line)] bg-[rgba(255,252,246,0.9)] text-[color:var(--ink)] shadow-sm transition hover:border-[rgba(45,124,75,0.24)] sm:hidden"
            >
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M4 12h16M4 17h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </div>
    </div>

    <div x-cloak x-show="open" class="border-t border-[color:var(--line)] bg-[rgba(255,249,241,0.96)] sm:hidden">
        <div class="shell-container space-y-2 py-4">
            @foreach($links as $link)
                <x-responsive-nav-link :href="$link['route']" :active="$link['active']">
                    {{ $link['label'] }}
                </x-responsive-nav-link>
            @endforeach

            <div class="mt-4 rounded-[1.5rem] border border-[color:var(--line)] bg-white/70 p-4">
                <div class="flex items-center gap-3">
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2d7c4b&color=fff&bold=true"
                        class="h-11 w-11 rounded-full"
                        alt="Avatar"
                    >
                    <div>
                        <p class="text-sm font-bold text-[color:var(--ink)]">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-[color:var(--muted)]">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="mt-4 space-y-2">
                    <x-responsive-nav-link :href="route('profile.edit')">Profile Settings</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link
                            :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-[color:var(--danger)]"
                        >
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
