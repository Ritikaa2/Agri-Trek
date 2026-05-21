<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Weather intelligence</span>
            <div>
                <h1 class="page-title">Agri-weather forecast</h1>
                <p class="page-subtitle">Use current conditions and the short-term outlook to plan field work with more confidence.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container space-y-6">
        @if(!empty($weatherData['alerts']))
            <div class="info-banner">
                <div class="mt-1 h-10 w-10 shrink-0 rounded-full bg-[rgba(199,134,50,0.14)]"></div>
                <div>
                    <h2 class="text-2xl font-semibold">Weather alert and advisory</h2>
                    <div class="mt-2 space-y-2 text-sm leading-7 text-muted">
                        @foreach($weatherData['alerts'] as $alert)
                            <p>{{ $alert }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
            <div class="panel-strong">
                <span class="section-badge">Current conditions</span>
                <div class="mt-5 flex flex-col gap-2 text-sm text-muted sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-semibold text-[color:var(--ink)]">
                            {{ $weatherData['location']['name'] ?? 'Weather location unavailable' }}
                        </p>
                        <p class="mt-1">
                            Using {{ $weatherData['location']['resolved_from'] ?? 'current settings' }}
                        </p>
                    </div>
                    <div class="text-left sm:text-right">
                        <p>Updated {{ $weatherData['meta']['updated_at'] ?? now()->format('D, M j, g:i A') }}</p>
                        <p class="mt-1">{{ $weatherData['meta']['timezone'] ?? config('app.timezone') }} via {{ $weatherData['meta']['source'] ?? 'weather source' }}</p>
                    </div>
                </div>

                <div class="mt-6 flex items-end gap-4">
                    <p class="text-7xl font-semibold">{{ $weatherData['current']['temp'] }}&deg;</p>
                    <div class="pb-2">
                        <p class="text-2xl font-semibold">{{ $weatherData['current']['condition'] }}</p>
                        <p class="mt-1 text-sm text-muted">Feels like {{ $weatherData['current']['feels_like'] }}&deg;</p>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="panel-soft">
                        <p class="eyebrow">Humidity</p>
                        <p class="mt-2 text-2xl font-semibold">{{ $weatherData['current']['humidity'] }}%</p>
                    </div>
                    <div class="panel-soft">
                        <p class="eyebrow">Wind</p>
                        <p class="mt-2 text-2xl font-semibold">{{ $weatherData['current']['wind'] }}</p>
                    </div>
                </div>
            </div>

            <div class="panel">
                <h2 class="text-3xl font-semibold">5-day agricultural forecast</h2>
                @if($weatherData['available'] && !empty($weatherData['forecast']))
                    <div class="mt-8 space-y-3">
                        @foreach($weatherData['forecast'] as $day)
                            <div class="flex flex-col gap-3 rounded-[1.4rem] border border-[color:var(--line)] bg-white/70 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-lg font-semibold">{{ $day['day'] }}</p>
                                    <p class="mt-1 text-sm text-muted">{{ $day['date'] }} • {{ $day['condition'] }}</p>
                                </div>
                                <div class="flex flex-col gap-2 sm:items-end">
                                    <div class="flex items-center gap-3">
                                        <span class="status-pill {{ $day['status'] === 'Moisture watch' ? 'status-warning' : ($day['status'] === 'Wind watch' ? 'status-danger' : 'status-info') }}">
                                            {{ $day['status'] }}
                                        </span>
                                        <p class="text-2xl font-semibold">{{ $day['temp_max'] }}&deg; / {{ $day['temp_min'] }}&deg;C</p>
                                    </div>
                                    <p class="text-sm text-muted">
                                        Rain chance {{ $day['precipitation_probability'] }}% • Rain {{ $day['precipitation_sum'] }} mm • Wind {{ $day['wind_speed'] }} km/h
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state mt-8">
                        <h3 class="text-2xl font-semibold">Live forecast unavailable</h3>
                        <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-muted">
                            {{ $weatherData['alerts'][0] ?? 'We could not load live weather data right now.' }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
