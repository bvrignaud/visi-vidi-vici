<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebcamResource;
use App\Models\Webcam;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WebcamsController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $webcams = Webcam::select([
            'id',
            'title',
            'url',
            'lat',
            'lng',
        ])->when($request['lat'] && $request['lng'], function (Builder $query) use ($request) {
            $query
                ->selectRaw(
                    'ACOS(SIN(PI() * ? / 180.0)*SIN(PI()*lat/180.0)+COS(PI() * ? / 180.0)*COS(PI()*lat/180.0)*COS(PI()*lng/180.0-PI() * ? / 180.0))*6371 distance',
                    [(float) $request['lat'], (float) $request['lat'], (float) $request['lng']]
                )
                ->whereBetween('lat', [$request['lat'] - 0.1, $request['lat'] + 0.1])
                ->whereBetween('lng', [$request['lng'] - 0.1, $request['lng'] + 0.1])
                ->orderBy('distance');
        })
            ->orderBy('title')
            ->get();

        return WebcamResource::collection($webcams);
    }
}
