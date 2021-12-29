<?php

namespace App\Http\Controllers;

use App\Services\StormGlassAPI;

trait SpotTrait
{
    private function getWeatherPointAvgByDay(StormGlassAPI $stormGlassAPI, float $lat, float $lng): array
    {
        $weathers = $stormGlassAPI->getWeatherPoint($lat, $lng, (new \DateTime())->sub(new \DateInterval('P5D')));

        $forecastsSum = [];
        foreach ($weathers as $weather) {
            $date = (new \DateTime($weather['time']))->format('Y-m-d');
            if (empty($forecastsSum[$date])) {
                $forecastsSum[$date]['count'] = 0;
            }
            $forecastsSum[$date]['count']++;
            foreach ($weather as $key => $value) {
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
}
