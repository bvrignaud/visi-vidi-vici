<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spot;
use App\Services\StormGlassAPI;
use Carbon\CarbonPeriod;
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

        $carbonPeriod = CarbonPeriod::create('now -5 days', '1 days', 10);

        $weathers = $this->getWeatherPointAvgByDay($stormGlassAPI, $spot->lat, $spot->lng);

        $tides = $stormGlassAPI->getTideExtremesPoint($spot->lat , $spot->lng, (new \DateTime())->sub(new \DateInterval('P5D')));

        $forecasts = [];
        foreach ($carbonPeriod as $carbon) {
            $forecasts[$carbon->format('Y-m-d')] = [
                'sun' => array_map(
                    fn($timestamp): string => date('H:i', $timestamp),
                    date_sun_info($carbon->getTimestamp(), $spot->lat, $spot->lng)
                ),
            ];
        }

        return new Response(compact('spot', 'weathers', 'tides', 'forecasts'));
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
