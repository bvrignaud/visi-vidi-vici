<?php

declare(strict_types=1);

namespace App\Services\StormGlassApi;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

/**
 * Class StormGlassAPI
 *
 * @see https://docs.stormglass.io
 */
class StormGlassAPI
{
    /**
     * @throws RequestException
     *
     * @phpstan-ignore missingType.iterableValue
     */
    public function getWeatherPoint(float $lat, float $lng, ?\DateTime $start = null, ?\DateTime $end = null): array
    {
        $cacheKey = "StormGlassWeatherPoint?lat={$lat}&lng={$lng}";
        $cacheKey .= $start ? "&start={$start->format('Y-m-d')}" : '';
        $cacheKey .= $end ? "&end={$end->format('Y-m-d')}" : '';

        return \Cache::remember($cacheKey, 3600 * 2, function () use ($lat, $lng, $start, $end) {
            $response = Http::withHeaders([
                'Authorization' => config('services.stormglass.key'),
            ])->get('https://api.stormglass.io/v2/weather/point', [
                'lat' => $lat,
                'lng' => $lng,
                'params' => 'airTemperature,cloudCover,waterTemperature,windSpeed,windDirection,swellHeight,swellPeriod',
                'start' => $start?->getTimestamp(),
                'end' => $end?->getTimestamp(),
            ]);

            $response->throw();

            $hours = $response->json()['hours'];

            foreach ($hours as &$hour) {
                $hour['cloudCover'] = round(array_sum(array_values($hour['cloudCover'])) / count($hour['cloudCover']), 1);

                $airTemperatures = array_values($hour['airTemperature']);
                $airTemperatures = Arr::reject($airTemperatures, fn (float $value) => $value < -100);
                $hour['airTemperature'] = round(array_sum($airTemperatures) / count($airTemperatures), 1);

                $hour['swellHeight'] = empty($hour['swellHeight']) ? null : round(array_sum(array_values($hour['swellHeight'])) / count($hour['swellHeight']), 1);
                $hour['swellPeriod'] = empty($hour['swellPeriod']) ? null : round(array_sum(array_values($hour['swellPeriod'])) / count($hour['swellPeriod']));
                $hour['waterTemperature'] = round(array_sum(array_values($hour['waterTemperature'])) / count($hour['waterTemperature']), 0);
                $hour['windDirection'] = round(array_sum(array_values($hour['windDirection'])) / count($hour['windDirection']), 0);
                $hour['windSpeed'] = round(array_sum(array_values($hour['windSpeed'])) / count($hour['windSpeed']), 0);
            }

            return $hours;
        });
    }

    /**
     * @throws RequestException
     *
     * @phpstan-ignore missingType.iterableValue
     */
    public function getTideExtremesPoint(float $lat, float $lng, ?\DateTime $start = null): array
    {
        return \Cache::remember(
            "StormGlassTideExtremesPoint?lat={$lat}&lng={$lng}&start={$start?->format('Ymd')}",
            3600 * 24 * 7,
            function () use ($lat, $lng, $start) {
                $response = Http::withHeaders([
                    'Authorization' => config('services.stormglass.key'),
                ])->get('https://api.stormglass.io/v2/tide/extremes/point', [
                    'lat' => $lat,
                    'lng' => $lng,
                    'start' => $start?->getTimestamp(),
                ])->throw();

                return $response->json()['data'];
            }
        );
    }
}
