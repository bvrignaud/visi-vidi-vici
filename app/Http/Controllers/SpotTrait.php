<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Services\StormGlassAPI;

trait SpotTrait
{
    private function getWeatherPointAvgByDay(StormGlassAPI $stormGlassAPI, Spot $spot): array
    {
        $weathers = $stormGlassAPI->getWeatherPoint($spot->lat, $spot->lng, (new \DateTime())->sub(new \DateInterval('P5D')));

        $forecastsSum = [];
        $note = 5;
        foreach ($weathers as $weather) {
            $date = (new \DateTime($weather['time']))->format('Y-m-d');
            if (empty($forecastsSum[$date])) {
                $forecastsSum[$date]['count'] = 0;
                $forecastsSum[$date]['note'] = 0;
            }
            $forecastsSum[$date]['count']++;
            foreach ($weather as $key => $value) {
                switch ($key) {
                    case 'swellHeight':
                        $note += $this->calculNoteForSwell($value);
                        $note = $note < 0 ? 0 : ($note > 10 ? 10 : $note);
                        $forecastsSum[$date]['note'] += $note;
                        break;
                    case 'windDirection':
                        $note += $this->calculNoteForWind($spot->optimal_wind_direction, $value);
                        $note = $note < 0 ? 0 : ($note > 10 ? 10 : $note);
                        $forecastsSum[$date]['note'] += $note;
                        break;
                }
                if ($key !== 'time') {
                    $forecastsSum[$date][$key] = (empty($forecastsSum[$date][$key]) ? 0 : $forecastsSum[$date][$key]) + $value;
                }
            }
        }

        $forecasts = [];
        foreach ($forecastsSum as $date => $value) {
            foreach ($value as $key => $sum) {
                if ($key !== 'count') {
                    $forecasts[$date][$key] = round($sum / $value['count'], PHP_ROUND_HALF_UP);
                }
            }
        }

        return $forecasts;
    }

    /**
     * @param float $bestWindDirection
     * @param float $windDirection
     * @return float note between -1 and 1
     */
    private function calculNoteForWind(float $bestWindDirection, float $windDirection): float
    {
        $e = abs($bestWindDirection - $windDirection) % 360;
        $note = (90 - $e) / 90;
        return $note;
    }

    private function calculNoteForSwell(float $swell): float
    {
        return 0.5 - $swell;
    }
}
