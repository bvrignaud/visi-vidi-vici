<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpotStoreRequest;
use App\Models\Spot;
use App\Services\StormGlassAPI;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpotsController extends Controller
{

    public function index(): \Inertia\Response
    {
        return Inertia::render('Spots/Index', [
            'spots' => Spot::orderBy('name')->get(),
        ]);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('spots.form');
    }

    public function store(SpotStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        Spot::create($request->only([
            'name',
            'lng',
            'lat',
        ]));
        return back()->with('spot_store', 'Merci pour votre contribution.');
    }

    public function show(Spot $spot): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $stormGlassAPI = new StormGlassAPI();

        $weathers = $this->getWeatherPointAvgByDay($stormGlassAPI, $spot->lat, $spot->lng);

        $tides = $stormGlassAPI->getTideExtremesPoint($spot->lat , $spot->lng, (new \DateTime())->sub(new \DateInterval('P5D')));

        return view('spot', compact('spot', 'weathers', 'tides'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function edit(Spot $spot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpotStoreRequest $request, Spot $spot): \Illuminate\Http\RedirectResponse
    {
        $spot->update($request->only([
            'name',
            'lng',
            'lat',
        ]));
        return back()->with('spot_store', 'Merci pour votre contribution.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spot $spot)
    {
        //
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
                    $forecasts[$date][$key] = $sum / $value['count'];
                }
            }
        }

        return $forecasts;
    }
}
