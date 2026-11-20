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
        $coordinates = $request->validate([
            'lat' => ['nullable', 'numeric', 'between:-90,90'],
            'lng' => ['nullable', 'numeric', 'between:-180,180'],
        ]);

        $webcams = Webcam::select([
            'id',
            'title',
            'url',
            'lat',
            'lng',
        ])->when(isset($coordinates['lat'], $coordinates['lng']), function (Builder $query) use ($coordinates): void {
            $query
                ->selectRaw(
                    'ACOS(SIN(PI() * ? / 180.0)*SIN(PI()*lat/180.0)+COS(PI() * ? / 180.0)*COS(PI()*lat/180.0)*COS(PI()*lng/180.0-PI() * ? / 180.0))*6371 distance',
                    [(float) $coordinates['lat'], (float) $coordinates['lat'], (float) $coordinates['lng']]
                )
                ->whereBetween('lat', [$coordinates['lat'] - 0.1, $coordinates['lat'] + 0.1])
                ->whereBetween('lng', [$coordinates['lng'] - 0.1, $coordinates['lng'] + 0.1])
                ->orderBy('distance');
        })
            ->orderBy('title')
            ->get();

        return WebcamResource::collection($webcams);
    }
}
