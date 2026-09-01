<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SpotFactory;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\Attributes\Sluggable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

#[Fillable([
    'name',
    'slug',
    'lng',
    'lat',
    'optimal_wind_direction',
    'timezone',
])]
#[Sluggable(from: 'name', to: 'slug')]
#[Appends(['route_key'])]
class Spot extends Model
{
    /** @use HasFactory<SpotFactory> */
    use HasFactory;

    use HasSlug;
    use HasUuids;

    /**
     * @return Attribute<mixed, null>
     */
    protected function routeKey(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->getRouteKey();
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->selfHealing(separator: '--');
    }

    protected function casts(): array
    {
        return [
            'optimal_wind_direction' => 'integer',
        ];
    }
}
