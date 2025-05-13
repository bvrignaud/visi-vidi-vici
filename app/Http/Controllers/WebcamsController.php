<?php

declare(strict_types=1);

namespace App\Http\Controllers;

// use App\Http\Requests\StoreWebcamsRequest;
// use App\Http\Requests\UpdateWebcamsRequest;
// use App\Models\Webcams;
use Inertia\Inertia;

class WebcamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('webcams/Index');
    }

    //    /**
    //     * Show the form for creating a new resource.
    //     *
    //     * @return \Illuminate\Http\Response
    //     */
    //    public function create()
    //    {
    //        //
    //    }
    //
    //    /**
    //     * Store a newly created resource in storage.
    //     *
    //     * @param  \App\Http\Requests\StoreWebcamsRequest  $request
    //     * @return \Illuminate\Http\Response
    //     */
    //    public function store(StoreWebcamsRequest $request)
    //    {
    //        //
    //    }
    //
    //    /**
    //     * Display the specified resource.
    //     *
    //     * @param  \App\Models\Webcams  $webcams
    //     * @return \Illuminate\Http\Response
    //     */
    //    public function show(Webcams $webcams)
    //    {
    //        //
    //    }
    //
    //    /**
    //     * Show the form for editing the specified resource.
    //     *
    //     * @param  \App\Models\Webcams  $webcams
    //     * @return \Illuminate\Http\Response
    //     */
    //    public function edit(Webcams $webcams)
    //    {
    //        //
    //    }
    //
    //    /**
    //     * Update the specified resource in storage.
    //     *
    //     * @param  \App\Http\Requests\UpdateWebcamsRequest  $request
    //     * @param  \App\Models\Webcams  $webcams
    //     * @return \Illuminate\Http\Response
    //     */
    //    public function update(UpdateWebcamsRequest $request, Webcams $webcams)
    //    {
    //        //
    //    }
    //
    //    /**
    //     * Remove the specified resource from storage.
    //     *
    //     * @param  \App\Models\Webcams  $webcams
    //     * @return \Illuminate\Http\Response
    //     */
    //    public function destroy(Webcams $webcams)
    //    {
    //        //
    //    }
}
