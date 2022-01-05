<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SpotTrait;
use App\Models\Spot;
use App\Services\StormGlassAPI;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Response;

class SpotsController extends Controller
{
    use SpotTrait;

    public function index(): \Illuminate\Support\Collection
    {
        return Spot::orderBy('name')->get();
    }

    public function getForecast(Spot $spot): Response
    {
        $stormGlassAPI = new StormGlassAPI();

        $carbonPeriod = CarbonPeriod::create('today -5 days', '1 days', 10);

        $weathers = $this->getWeatherPointAvgByDay($stormGlassAPI, $spot);

        $tides = $stormGlassAPI->getTideExtremesPoint($spot->lat , $spot->lng, Carbon::create('today -5 days'));

        $forecasts = [];
        foreach ($carbonPeriod as $carbon) {
            $forecasts[$carbon->format('Y-m-d')] = [
                'sun' => array_map(
                    fn($timestamp): string => Carbon::createFromTimestamp($timestamp)
                        ->setTimezone($spot->timezone)->format('H:i'),
                    date_sun_info($carbon->getTimestamp(), $spot->lat, $spot->lng)
                ),
            ];
        }

        return new Response(compact('spot', 'weathers', 'tides', 'forecasts'));
    }

}
