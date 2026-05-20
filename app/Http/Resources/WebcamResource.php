<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Webcam;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Webcam
 */
class WebcamResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
