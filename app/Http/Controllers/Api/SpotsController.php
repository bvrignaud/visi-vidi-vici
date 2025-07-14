<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Forecasts\GetWeatherPoint;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetForecastRequest;
use App\Models\Spot;
use App\Services\StormGlassApi\ErrorCodes;
use App\Services\StormGlassApi\StormGlassAPI;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Sentry;

class SpotsController extends Controller
{
    /**
     * @return Collection<int, Spot>
     */
    public function index(): Collection
    {
        return Spot::orderBy('name')->get();
    }

    public function getForecast(Spot $spot, GetForecastRequest $request): Response
    {
        $stormGlassAPI = new StormGlassAPI;

        $start = $request->date('start') ?: Carbon::today()->sub(new \DateInterval('P4D'));

        $carbonPeriod = CarbonPeriod::create($start, '1 days', 10);

        try {
            $forecasts = GetWeatherPoint::get($spot, $start->toImmutable());
            $tides = $stormGlassAPI->getTideExtremesPoint($spot->lat, $spot->lng, $start);
        } catch (RequestException $e) {
            Sentry::captureException($e);
            abort(402, ErrorCodes::from(402)->description());
        }

        $sun_infos = [];
        foreach ($carbonPeriod as $carbon) {
            $carbon->setTimezone($spot->timezone);
            $dateFormatted = $carbon->format('Y-m-d');
            $sun_infos[$dateFormatted] = array_map(
                fn ($timestamp): string|bool => is_bool($timestamp)
                    ? $timestamp
                    : Carbon::createFromTimestamp($timestamp)->setTimezone($spot->timezone)->format('H:i'),
                date_sun_info(strtotime($dateFormatted), $spot->lat, $spot->lng)
            );
        }

        return new Response(compact('forecasts', 'tides', 'sun_infos'));
    }
}
