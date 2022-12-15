<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebcamResource;
use App\Models\Webcams;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WebcamsController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $webcams = Webcams::orderBy('title')
            ->when($request->lat && $request->lng, function (Builder $query) use ($request) {
                $query
                    ->whereBetween('lat', [$request->lat - 0.1, $request->lat + 0.1])
                    ->whereBetween('lng', [$request->lng - 0.1, $request->lng + 0.1])
                ;
            })
            ->get();
        return WebcamResource::collection($webcams);
    }
}
