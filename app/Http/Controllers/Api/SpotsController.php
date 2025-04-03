<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SpotTrait;
use App\Models\Spot;
use App\Services\StormGlassAPI;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class SpotsController extends Controller
{
    use SpotTrait;

    /**
     * @return Collection<int, Spot>
     */
    public function index(): Collection
    {
        return Spot::orderBy('name')->get();
    }

    public function getForecast(Spot $spot): Response
    {
        $stormGlassAPI = new StormGlassAPI;

        $carbonPeriod = CarbonPeriod::create('today -5 days', '1 days', 10);

        $forecasts = $stormGlassAPI->getWeatherPoint($spot->lat, $spot->lng, Carbon::today()->sub(new \DateInterval('P5D')));

        $note = 5;
        foreach ($forecasts as &$forecast) {
            $note += $this->calculNoteForSwell($forecast['swellHeight']);
            $note += $this->calculNoteForSwellPeriod($forecast['swellPeriod']);
            $note += $this->calculNoteForWind($spot->optimal_wind_direction, $forecast['windDirection'], $forecast['windSpeed']);
            $note = $note < 0 ? 0 : min($note, 10);
            $forecast['note'] = $note;
        }

        $tides = $stormGlassAPI->getTideExtremesPoint($spot->lat, $spot->lng, Carbon::parse('today -5 days'));

        $sun_infos = [];
        foreach ($carbonPeriod as $carbon) {
            $sun_infos[$carbon->format('Y-m-d')] = array_map(
                fn ($timestamp): string => Carbon::createFromTimestamp($timestamp)
                    ->setTimezone($spot->timezone)->format('H:i'),
                date_sun_info($carbon->getTimestamp(), $spot->lat, $spot->lng)
            );
        }

        return new Response(compact('spot', 'forecasts', 'tides', 'sun_infos'));
    }
}
