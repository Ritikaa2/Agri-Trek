<?php

namespace App\Services;

use App\Models\Farmer;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class WeatherService
{
    public function getForUser(User $user): array
    {
        $location = $this->resolveLocationForUser($user);

        if (! $location) {
            return $this->unavailableWeatherData(
                'Add land coordinates or complete your village and district details in KYC to load live local weather.'
            );
        }

        $cacheKey = sprintf(
            'weather:%s:%s',
            number_format($location['latitude'], 4, '.', ''),
            number_format($location['longitude'], 4, '.', '')
        );

        if ($cached = Cache::get($cacheKey)) {
            return $cached;
        }

        try {
            $weatherData = $this->fetchWeather($location);

            Cache::put(
                $cacheKey,
                $weatherData,
                now()->addMinutes((int) config('services.weather.cache_minutes', 30))
            );

            return $weatherData;
        } catch (Throwable $e) {
            Log::warning('Unable to fetch live weather data.', [
                'location' => $location,
                'message' => $e->getMessage(),
            ]);

            return $this->unavailableWeatherData(
                'Live weather data is temporarily unavailable. Please try again in a few minutes.',
                $location
            );
        }
    }

    private function fetchWeather(array $location): array
    {
        $response = Http::acceptJson()
            ->timeout(10)
            ->retry(2, 300)
            ->get(config('services.weather.forecast_url'), [
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
                'current' => implode(',', [
                    'temperature_2m',
                    'relative_humidity_2m',
                    'apparent_temperature',
                    'weather_code',
                    'wind_speed_10m',
                    'is_day',
                ]),
                'daily' => implode(',', [
                    'weather_code',
                    'temperature_2m_max',
                    'temperature_2m_min',
                    'precipitation_probability_max',
                    'precipitation_sum',
                    'wind_speed_10m_max',
                ]),
                'timezone' => 'auto',
                'forecast_days' => 5,
            ])
            ->throw()
            ->json();

        $current = Arr::get($response, 'current', []);
        $daily = Arr::get($response, 'daily', []);
        $currentTime = CarbonImmutable::parse(Arr::get($current, 'time', now()->toIso8601String()));

        $forecast = collect(Arr::get($daily, 'time', []))
            ->map(function (string $date, int $index) use ($daily) {
                $dayDate = CarbonImmutable::parse($date);
                $condition = $this->describeWeatherCode((int) Arr::get($daily, "weather_code.{$index}", 0));
                $precipitationProbability = (int) round((float) Arr::get($daily, "precipitation_probability_max.{$index}", 0));
                $maxWindSpeed = $this->roundNumber(Arr::get($daily, "wind_speed_10m_max.{$index}", 0));

                return [
                    'day' => $index === 0 ? 'Today' : ($index === 1 ? 'Tomorrow' : $dayDate->format('l')),
                    'date' => $dayDate->format('M j'),
                    'condition' => $condition,
                    'temp_max' => $this->roundNumber(Arr::get($daily, "temperature_2m_max.{$index}", 0)),
                    'temp_min' => $this->roundNumber(Arr::get($daily, "temperature_2m_min.{$index}", 0)),
                    'precipitation_probability' => $precipitationProbability,
                    'precipitation_sum' => round((float) Arr::get($daily, "precipitation_sum.{$index}", 0), 1),
                    'wind_speed' => $maxWindSpeed,
                    'status' => $this->dailyStatus($condition, $precipitationProbability, $maxWindSpeed),
                ];
            })
            ->values()
            ->all();

        return [
            'available' => true,
            'location' => [
                'name' => $location['name'],
                'resolved_from' => $location['resolved_from'],
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
            ],
            'meta' => [
                'source' => 'Open-Meteo',
                'updated_at' => $currentTime->format('D, M j, g:i A'),
                'timezone' => (string) Arr::get($response, 'timezone', 'Local'),
            ],
            'current' => [
                'temp' => $this->roundNumber(Arr::get($current, 'temperature_2m', 0)),
                'condition' => $this->describeWeatherCode((int) Arr::get($current, 'weather_code', 0)),
                'humidity' => (int) round((float) Arr::get($current, 'relative_humidity_2m', 0)),
                'wind' => $this->formatWind(Arr::get($current, 'wind_speed_10m', 0)),
                'wind_speed' => $this->roundNumber(Arr::get($current, 'wind_speed_10m', 0)),
                'feels_like' => $this->roundNumber(Arr::get($current, 'apparent_temperature', 0)),
                'is_day' => (bool) Arr::get($current, 'is_day', true),
            ],
            'forecast' => $forecast,
            'alerts' => $this->buildAlerts($forecast),
        ];
    }

    private function resolveLocationForUser(User $user): ?array
    {
        $farmer = $user->farmer;

        if ($farmer) {
            $land = $farmer->lands()->latest('id')->first();
            $coordinates = $this->parseCoordinates($land?->location_coords);

            if ($coordinates) {
                return [
                    'name' => $land?->crop_type
                        ? "{$land->crop_type} field weather"
                        : 'Registered field weather',
                    'resolved_from' => 'land coordinates',
                    'latitude' => $coordinates['latitude'],
                    'longitude' => $coordinates['longitude'],
                ];
            }

            if ($geocoded = $this->geocodeFarmerLocation($farmer)) {
                return $geocoded;
            }
        }

        return $this->fallbackLocation();
    }

    private function geocodeFarmerLocation(Farmer $farmer): ?array
    {
        $queries = array_values(array_filter(array_unique([
            trim(implode(', ', array_filter([$farmer->village, $farmer->district, 'India']))),
            trim(implode(', ', array_filter([$farmer->district, 'India']))),
            trim((string) $farmer->address),
        ])));

        foreach ($queries as $query) {
            $params = [
                'name' => $query,
                'count' => 1,
                'language' => 'en',
            ];

            if ($countryCode = config('services.weather.country_code')) {
                $params['countryCode'] = $countryCode;
            }

            $response = Http::acceptJson()
                ->timeout(10)
                ->retry(2, 300)
                ->get(config('services.weather.geocoding_url'), $params)
                ->throw()
                ->json();

            $result = Arr::get($response, 'results.0');

            if ($result) {
                $adminParts = array_filter([
                    Arr::get($result, 'name'),
                    Arr::get($result, 'admin1'),
                    Arr::get($result, 'country'),
                ]);

                return [
                    'name' => implode(', ', $adminParts),
                    'resolved_from' => 'village/district',
                    'latitude' => (float) Arr::get($result, 'latitude'),
                    'longitude' => (float) Arr::get($result, 'longitude'),
                ];
            }
        }

        return null;
    }

    private function fallbackLocation(): ?array
    {
        $latitude = config('services.weather.fallback_latitude');
        $longitude = config('services.weather.fallback_longitude');

        if ($latitude === null || $longitude === null) {
            return null;
        }

        return [
            'name' => (string) config('services.weather.fallback_name', 'Default location'),
            'resolved_from' => 'fallback location',
            'latitude' => (float) $latitude,
            'longitude' => (float) $longitude,
        ];
    }

    private function parseCoordinates(?string $coordinates): ?array
    {
        if (! $coordinates) {
            return null;
        }

        $parts = array_map('trim', explode(',', $coordinates));

        if (count($parts) !== 2 || ! is_numeric($parts[0]) || ! is_numeric($parts[1])) {
            return null;
        }

        $latitude = (float) $parts[0];
        $longitude = (float) $parts[1];

        if ($latitude < -90 || $latitude > 90 || $longitude < -180 || $longitude > 180) {
            return null;
        }

        return [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }

    private function buildAlerts(array $forecast): array
    {
        $alerts = [];

        foreach ($forecast as $day) {
            if ($day['precipitation_probability'] >= 60) {
                $alerts[] = "High rain chance on {$day['day']} ({$day['date']}). Consider delaying pesticide spraying and harvest drying work.";
                break;
            }
        }

        foreach ($forecast as $day) {
            if ($day['wind_speed'] >= 25) {
                $alerts[] = "Stronger winds are expected on {$day['day']} ({$day['date']}). Avoid spraying in open plots during gusty hours.";
                break;
            }
        }

        foreach ($forecast as $day) {
            if ($day['temp_max'] >= 36) {
                $alerts[] = "High heat is expected on {$day['day']} ({$day['date']}). Plan irrigation and field labour early in the day.";
                break;
            }
        }

        if ($alerts === []) {
            $alerts[] = 'Weather looks fairly stable for the next few days. Check the forecast again before any spraying decision.';
        }

        return array_values(array_unique($alerts));
    }

    private function dailyStatus(string $condition, int $precipitationProbability, int|float $maxWindSpeed): string
    {
        if ($precipitationProbability >= 60 || str_contains(strtolower($condition), 'rain') || str_contains(strtolower($condition), 'storm')) {
            return 'Moisture watch';
        }

        if ($maxWindSpeed >= 25) {
            return 'Wind watch';
        }

        return 'Stable window';
    }

    private function describeWeatherCode(int $code): string
    {
        return match (true) {
            $code === 0 => 'Clear sky',
            in_array($code, [1, 2, 3], true) => 'Partly cloudy',
            in_array($code, [45, 48], true) => 'Fog',
            in_array($code, [51, 53, 55, 56, 57], true) => 'Drizzle',
            in_array($code, [61, 63, 65, 66, 67], true) => 'Rain',
            in_array($code, [71, 73, 75, 77, 85, 86], true) => 'Snow',
            in_array($code, [80, 81, 82], true) => 'Rain showers',
            in_array($code, [95, 96, 99], true) => 'Thunderstorms',
            default => 'Variable conditions',
        };
    }

    private function formatWind(int|float|string|null $speed): string
    {
        return $this->roundNumber($speed) . ' km/h';
    }

    private function roundNumber(int|float|string|null $value): int
    {
        return (int) round((float) $value);
    }

    private function unavailableWeatherData(string $message, ?array $location = null): array
    {
        return [
            'available' => false,
            'location' => $location ? [
                'name' => $location['name'],
                'resolved_from' => $location['resolved_from'],
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
            ] : null,
            'meta' => [
                'source' => 'Open-Meteo',
                'updated_at' => now()->format('D, M j, g:i A'),
                'timezone' => config('app.timezone'),
            ],
            'current' => [
                'temp' => 0,
                'condition' => 'Unavailable',
                'humidity' => 0,
                'wind' => '0 km/h',
                'wind_speed' => 0,
                'feels_like' => 0,
                'is_day' => true,
            ],
            'forecast' => [],
            'alerts' => [$message],
        ];
    }
}
