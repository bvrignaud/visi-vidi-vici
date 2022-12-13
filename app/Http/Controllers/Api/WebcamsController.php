<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebcamResource;
use App\Models\Webcams;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WebcamsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return WebcamResource::collection(Webcams::orderBy('title')->get());
    }
}
