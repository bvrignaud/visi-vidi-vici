<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SpotFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    /** @use HasFactory<SpotFactory> */
    use HasFactory;

    use HasUuids;

    protected $casts = [
        'optimal_wind_direction' => 'integer',
    ];

    protected $fillable = [
        'name',
        'lng',
        'lat',
        'optimal_wind_direction',
        'timezone',
    ];
}
