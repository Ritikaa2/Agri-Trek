<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MandiController extends Controller
{
    public function index()
    {
        // Simulated live market data (Mandi Prices)
        $mandiPrices = [
            ['crop' => 'Wheat (Lok-1)', 'price' => 2450, 'trend' => 'up', 'change' => '+1.5%'],
            ['crop' => 'Paddy (Basmati)', 'price' => 3200, 'trend' => 'up', 'change' => '+2.1%'],
            ['crop' => 'Cotton', 'price' => 6800, 'trend' => 'down', 'change' => '-0.8%'],
            ['crop' => 'Soybean', 'price' => 4500, 'trend' => 'stable', 'change' => '0.0%'],
            ['crop' => 'Mustard', 'price' => 5600, 'trend' => 'up', 'change' => '+0.5%'],
            ['crop' => 'Maize', 'price' => 2100, 'trend' => 'down', 'change' => '-1.2%'],
            ['crop' => 'Sugarcane', 'price' => 315, 'trend' => 'up', 'change' => '+0.2%'],
            ['crop' => 'Onion', 'price' => 1800, 'trend' => 'down', 'change' => '-5.4%'],
            ['crop' => 'Potato', 'price' => 1250, 'trend' => 'stable', 'change' => '0.0%'],
            ['crop' => 'Tomato', 'price' => 2200, 'trend' => 'up', 'change' => '+8.1%'],
        ];

        $mandiPrices = collect($mandiPrices)->map(function ($item, $index) {
            $changePercent = (float) str_replace(['+', '%'], '', $item['change']);
            $startPrice = round($item['price'] / (1 + ($changePercent / 100)));
            $thirtyDayChange = match ($item['trend']) {
                'up' => 3.5 + ($index * 0.45),
                'down' => -2.5 - ($index * 0.35),
                default => 0.4,
            };
            $price30DaysAgo = round($item['price'] / (1 + ($thirtyDayChange / 100)));

            return array_merge($item, [
                'price_30_days_ago' => $price30DaysAgo,
                'thirty_day_change' => round($thirtyDayChange, 1),
                'thirty_day_gain_loss' => $item['price'] - $price30DaysAgo,
                'history' => $this->buildThirtyDayHistory($price30DaysAgo, $item['price']),
                'day_start_price' => $startPrice,
            ]);
        })->all();

        $farmer = Auth::user()->farmer;
        $farmerCrops = $farmer
            ? $farmer->lands()
                ->whereNotNull('crop_type')
                ->pluck('crop_type')
                ->map(fn ($crop) => strtolower($crop))
                ->all()
            : [];

        $portfolioRows = collect($mandiPrices)
            ->filter(function ($item) use ($farmerCrops) {
                if (empty($farmerCrops)) {
                    return in_array($item['crop'], ['Wheat (Lok-1)', 'Paddy (Basmati)', 'Cotton', 'Soybean']);
                }

                return collect($farmerCrops)->contains(fn ($crop) => str_contains(strtolower($item['crop']), $crop));
            })
            ->values();

        $portfolioSummary = [
            'tracked_crops' => $portfolioRows->count(),
            'rising' => $portfolioRows->where('thirty_day_gain_loss', '>', 0)->count(),
            'falling' => $portfolioRows->where('thirty_day_gain_loss', '<', 0)->count(),
            'net_gain_loss' => $portfolioRows->sum('thirty_day_gain_loss'),
            'best' => $portfolioRows->sortByDesc('thirty_day_change')->first(),
            'worst' => $portfolioRows->sortBy('thirty_day_change')->first(),
        ];

        return view('farmer.mandi.index', compact('mandiPrices', 'portfolioRows', 'portfolioSummary'));
    }

    private function buildThirtyDayHistory(int $startPrice, int $endPrice): array
    {
        $history = [];

        for ($day = 0; $day < 30; $day++) {
            $progress = $day / 29;
            $wave = sin($day / 2.7) * 18;
            $price = round($startPrice + (($endPrice - $startPrice) * $progress) + $wave);

            $history[] = [
                'date' => now()->subDays(29 - $day)->format('M d'),
                'price' => max(1, $price),
            ];
        }

        return $history;
    }
}
