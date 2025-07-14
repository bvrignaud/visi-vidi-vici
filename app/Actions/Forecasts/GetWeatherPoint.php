<?php

declare(strict_types=1);

namespace App\Actions\Forecasts;

use App\Models\Forecast;
use App\Models\Spot;
use App\Services\StormGlassApi\StormGlassAPI;
use Carbon\CarbonImmutable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;

final class GetWeatherPoint
{
    /**
     * @return array<int, array{airTemprature: float, cloudCover: float, sweelHeight: float, sweelPeriod: float, time: string, waterTemperature: float, windDirection: float, windSpeed: float, note: float}>
     *
     * @throws RequestException
     */
    public static function get(Spot $spot, CarbonImmutable $start): array
    {
        $cacheKey = "GetWeatherPoint?spot_id=$$spot->id&start={$start->format('Y-m-d')}";

        return Cache::remember($cacheKey, 3600 * 4, function () use ($start, $spot) {

            $stormGlassAPI = new StormGlassAPI;

            $forecasts = $stormGlassAPI->getWeatherPoint($spot->lat, $spot->lng, $start->toDateTime());

            $lastForecast = Forecast::where('spot_id', $spot->id)
                ->whereDate('time', '<', $start)
                ->whereDate('time', '>', $start->subDays(2))
                ->orderBy('time', 'desc')
                ->first();

            $note = $lastForecast->note ?? 5;

            foreach ($forecasts as &$forecast) {
                $note += self::calculNoteForSwell($forecast['swellHeight']);
                $note += self::calculNoteForSwellPeriod($forecast['swellPeriod']);
                $note += self::calculNoteForWind($spot, $forecast['windDirection'], $forecast['windSpeed']);
                $note = $note < 0 ? 0 : min($note, 10);
                $forecast['note'] = $note;

                Forecast::updateOrCreate(
                    ['spot_id' => $spot->id, 'time' => $forecast['time']],
                    [
                        'note' => $note,
                    ]
                );
            }

            return $forecasts;
        });
    }

    /**
     * @param  float  $windSpeed  Speed of wind at 10 m above sea level in meters per second.
     * @return float note between -1 and 1
     */
    private static function calculNoteForWind(Spot $spot, float $windDirection, float $windSpeed): float
    {
        $e = abs($spot->optimal_wind_direction - $windDirection) % 360;
        $note = (90 - $e) / 90;

        return $note * $windSpeed / 20;
    }

    private static function calculNoteForSwell(float $swell): float
    {
        return 0.5 - $swell;
    }

    private static function calculNoteForSwellPeriod(float $swellPeriod): float
    {
        return (9 - $swellPeriod) / 10;
    }
}
