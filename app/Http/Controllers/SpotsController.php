<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpotStoreRequest;
use App\Models\Spot;
use App\Services\StormGlassAPI;
use Inertia\Inertia;

class SpotsController extends Controller
{
    use SpotTrait;

    public function index(): \Inertia\Response
    {
        return Inertia::render('Spots/Index', [
            'spots' => Spot::orderBy('name')->get(),
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Spots/Form');
    }

    public function store(SpotStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        Spot::create($request->only([
            'name',
            'lng',
            'lat',
            'optimal_wind_direction',
        ]));
        return redirect('/')->with([
            'flash.banner' => "'{$request->name}' à été ajouté à la liste des spots. Merci pour votre contribution.",
            'flash.bannerStyle' => 'success',
        ]);
    }

    public function show(Spot $spot): \Inertia\Response
    {
        $stormGlassAPI = new StormGlassAPI();

        $weathers = $this->getWeatherPointAvgByDay($stormGlassAPI, $spot);

        $tides = $stormGlassAPI->getTideExtremesPoint($spot->lat , $spot->lng, (new \DateTime())->sub(new \DateInterval('P5D')));

        return Inertia::render('Spots/Show', compact('spot', 'weathers', 'tides'));
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
        return back()->with([
            'flash.banner' => "'{$request->name}' à bien été modifié. Merci pour votre contribution.",
            'flash.bannerStyle' => 'success',
        ]);
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

}
