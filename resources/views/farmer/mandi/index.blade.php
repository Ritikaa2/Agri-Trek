<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Market tracking</span>
            <div>
                <h1 class="page-title">Live mandi prices</h1>
                <p class="page-subtitle">Review commodity movement, 30-day changes, and simple portfolio cues before selling.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container space-y-6">
        <div class="panel">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h2 class="text-3xl font-semibold">Current market rates</h2>
                    <p class="mt-3 text-sm leading-7 text-muted">Prices reflect average local mandi rates per quintal (100kg).</p>
                </div>
                <div class="status-pill status-success">Live updates active</div>
            </div>
        </div>

        <div class="table-shell">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="table-head">
                        <tr>
                            <th class="px-6 py-4">Commodity</th>
                            <th class="px-6 py-4">Price (Rs./Qtl)</th>
                            <th class="px-6 py-4">Trend</th>
                            <th class="px-6 py-4">24h Change</th>
                            <th class="px-6 py-4">30 Day</th>
                            <th class="px-6 py-4">Gain / Loss</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[rgba(255,252,246,0.78)]">
                        @foreach($mandiPrices as $data)
                            <tr class="table-row">
                                <td class="px-6 py-5 font-semibold text-[color:var(--ink)]">{{ $data['crop'] }}</td>
                                <td class="px-6 py-5 font-mono text-[color:var(--ink)]">Rs. {{ number_format($data['price']) }}</td>
                                <td class="px-6 py-5">
                                    @if($data['trend'] === 'up')
                                        <span class="status-pill status-success">Rising</span>
                                    @elseif($data['trend'] === 'down')
                                        <span class="status-pill status-danger">Falling</span>
                                    @else
                                        <span class="status-pill status-info">Stable</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 {{ str_starts_with($data['change'], '+') ? 'text-[color:var(--success)]' : (str_starts_with($data['change'], '-') ? 'text-[color:var(--danger)]' : 'text-muted') }}">
                                    {{ $data['change'] }}
                                </td>
                                <td class="px-6 py-5 font-semibold {{ $data['thirty_day_change'] > 0 ? 'text-[color:var(--success)]' : ($data['thirty_day_change'] < 0 ? 'text-[color:var(--danger)]' : 'text-muted') }}">
                                    {{ $data['thirty_day_change'] > 0 ? '+' : '' }}{{ $data['thirty_day_change'] }}%
                                </td>
                                <td class="px-6 py-5 font-mono font-semibold {{ $data['thirty_day_gain_loss'] > 0 ? 'text-[color:var(--success)]' : ($data['thirty_day_gain_loss'] < 0 ? 'text-[color:var(--danger)]' : 'text-muted') }}">
                                    {{ $data['thirty_day_gain_loss'] > 0 ? '+' : '' }}Rs. {{ number_format($data['thirty_day_gain_loss']) }}/Qtl
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="portfolio-analysis" class="panel">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h2 class="text-3xl font-semibold">Portfolio analysis</h2>
                    <p class="mt-3 text-sm leading-7 text-muted">Thirty-day movement for your tracked mandi crops.</p>
                </div>
                <div class="grid gap-3 sm:grid-cols-4">
                    <div class="panel-soft">
                        <p class="eyebrow">Tracked</p>
                        <p class="mt-2 text-2xl font-semibold">{{ $portfolioSummary['tracked_crops'] }}</p>
                    </div>
                    <div class="panel-soft">
                        <p class="eyebrow">Rising</p>
                        <p class="mt-2 text-2xl font-semibold text-[color:var(--success)]">{{ $portfolioSummary['rising'] }}</p>
                    </div>
                    <div class="panel-soft">
                        <p class="eyebrow">Falling</p>
                        <p class="mt-2 text-2xl font-semibold text-[color:var(--danger)]">{{ $portfolioSummary['falling'] }}</p>
                    </div>
                    <div class="panel-soft">
                        <p class="eyebrow">Net / Qtl</p>
                        <p class="mt-2 text-2xl font-semibold {{ $portfolioSummary['net_gain_loss'] >= 0 ? 'text-[color:var(--success)]' : 'text-[color:var(--danger)]' }}">
                            {{ $portfolioSummary['net_gain_loss'] >= 0 ? '+' : '' }}Rs. {{ number_format($portfolioSummary['net_gain_loss']) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-8 grid gap-4 lg:grid-cols-2">
                @foreach($portfolioRows as $row)
                    <div class="panel-soft">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-semibold">{{ $row['crop'] }}</h3>
                                <p class="mt-2 text-xs uppercase tracking-[0.16em] text-muted">
                                    30 days ago Rs. {{ number_format($row['price_30_days_ago']) }} to today Rs. {{ number_format($row['price']) }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold {{ $row['thirty_day_gain_loss'] >= 0 ? 'text-[color:var(--success)]' : 'text-[color:var(--danger)]' }}">
                                    {{ $row['thirty_day_gain_loss'] >= 0 ? '+' : '' }}Rs. {{ number_format($row['thirty_day_gain_loss']) }}
                                </p>
                                <p class="mt-1 text-xs font-bold {{ $row['thirty_day_change'] >= 0 ? 'text-[color:var(--success)]' : 'text-[color:var(--danger)]' }}">
                                    {{ $row['thirty_day_change'] >= 0 ? '+' : '' }}{{ $row['thirty_day_change'] }}%
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 flex h-24 items-end gap-1">
                            @foreach($row['history'] as $point)
                                @php
                                    $min = collect($row['history'])->min('price');
                                    $max = collect($row['history'])->max('price');
                                    $height = $max === $min ? 50 : 20 + (($point['price'] - $min) / ($max - $min) * 60);
                                @endphp
                                <div title="{{ $point['date'] }}: Rs. {{ number_format($point['price']) }}" class="flex-1 rounded-t {{ $row['thirty_day_gain_loss'] >= 0 ? 'bg-[rgba(44,125,95,0.75)]' : 'bg-[rgba(181,85,68,0.72)]' }}" style="height: {{ $height }}px"></div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="panel-strong">
            <span class="section-badge">AI market insight</span>
            <h2 class="mt-5 text-3xl font-semibold">Suggested reading of the current cycle</h2>
            <p class="mt-4 text-sm leading-7 text-muted">
                Wheat (Lok-1) and Paddy (Basmati) continue to show strong upward movement. If your storage setup is dependable, waiting 5 to 7 days may improve returns. Soybean remains steady and is still suitable for immediate offload.
            </p>
            <a href="#portfolio-analysis" class="btn-primary mt-6">Analyze Portfolio</a>
        </div>
    </div>
</x-app-layout>
