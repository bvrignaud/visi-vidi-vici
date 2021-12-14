<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spot;
use App\Services\StormGlassAPI;
use Illuminate\Http\Response;

class SpotsController extends Controller
{
    public function index()
    {
        return Spot::orderBy('name')->get();
    }

    public function getForecast(Spot $spot): Response
    {
        $stormGlassAPI = new StormGlassAPI();

        $weathers = $this->getWeatherPointAvgByDay($stormGlassAPI, $spot->lat, $spot->lng);

        $tides = $stormGlassAPI->getTideExtremesPoint($spot->lat , $spot->lng, (new \DateTime())->sub(new \DateInterval('P5D')));

        return new Response(compact('spot', 'weathers', 'tides'));
    }

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
