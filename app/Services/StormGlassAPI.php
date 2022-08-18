<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Class StormGlassAPI
 *
 * @see https://docs.stormglass.io
 */
class StormGlassAPI
{
    public function getWeatherPoint(float $lat, float $lng, ?\DateTime $start = null, ?\DateTime $end = null): array
    {
        $cacheKey = "StormGlassWeatherPoint?lat=$lat&lng=$lng";
        $cacheKey .= $start ? "&start={$start->format('Y-m-d')}" : '';
        $cacheKey .= $end ? "&end={$end->format('Y-m-d')}" : '';

        return \Cache::remember($cacheKey, 3600, function () use ($lat, $lng, $start, $end) {
            $response = Http::withHeaders([
                'Authorization' => config('app.stormglass_key'),
            ])->get('https://api.stormglass.io/v2/weather/point', [
                'lat' => $lat,
                'lng' => $lng,
                'params' => 'airTemperature,cloudCover,windSpeed,windDirection,swellHeight',
                'start' => $start?->getTimestamp(),
                'end' => $end?->getTimestamp(),
            ]);

            $response->throw();

            $hours = $response->json()['hours'];

            foreach ($hours as &$hour) {
                $hour['cloudCover'] = round(array_sum(array_values($hour['cloudCover'])) / count($hour['cloudCover']), 1);
                $hour['airTemperature'] = round(array_sum(array_values($hour['airTemperature'])) / count($hour['airTemperature']), 1);
                $hour['swellHeight'] = empty($hour['swellHeight']) ? null : round(array_sum(array_values($hour['swellHeight'])) / count($hour['swellHeight']), 1);
                $hour['windDirection'] = round(array_sum(array_values($hour['windDirection'])) / count($hour['windDirection']), 0);
                $hour['windSpeed'] = round(array_sum(array_values($hour['windSpeed'])) / count($hour['windSpeed']), 0);
            }

            return $hours;
        });
    }

    public function getTideExtremesPoint(float $lat, float $lng, ?\DateTime $start = null): array
    {
        return \Cache::remember("StormGlassTideExtremesPoint?lat=$lat&lng=$lng&start={$start?->format('Ymd')}", 3600, function () use ($lat, $lng, $start) {
            $response = Http::withHeaders([
                'Authorization' => config('app.stormglass_key'),
            ])->get('https://api.stormglass.io/v2/tide/extremes/point', [
                'lat' => $lat,
                'lng' => $lng,
                'start' => $start?->getTimestamp(),
            ]);

            return $response->json()['data'];
        });
    }
}
