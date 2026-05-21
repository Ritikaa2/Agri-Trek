<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Support\Facades\Auth;

class WeatherController extends Controller
{
    public function index(WeatherService $weatherService)
    {
        $weatherData = $weatherService->getForUser(Auth::user());

        return view('farmer.weather.index', compact('weatherData'));
    }
}
