<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('farmer.mandi.index', compact('mandiPrices'));
    }
}
