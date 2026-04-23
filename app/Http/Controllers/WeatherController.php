<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index()
    {
        // Simulated weather data for the farmer's region
        $weatherData = [
            'current' => [
                'temp' => 32,
                'condition' => 'Partly Cloudy',
                'humidity' => 65,
                'wind' => '12 km/h',
            ],
            'forecast' => [
                ['day' => 'Tomorrow', 'temp' => 34, 'condition' => 'Sunny'],
                ['day' => 'Wednesday', 'temp' => 30, 'condition' => 'Rain Showers'],
                ['day' => 'Thursday', 'temp' => 28, 'condition' => 'Thunderstorms'],
                ['day' => 'Friday', 'temp' => 29, 'condition' => 'Partly Cloudy'],
                ['day' => 'Saturday', 'temp' => 31, 'condition' => 'Sunny'],
            ],
            'alerts' => [
                'High probability of rain on Wednesday. Delay pesticide spraying.',
            ]
        ];

        return view('farmer.weather.index', compact('weatherData'));
    }
}
