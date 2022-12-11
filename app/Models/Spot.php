<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Spot
 *
 * @property string $id
 * @property string $name
 * @property float $lng
 * @property float $lat
 * @property int $optimal_wind_direction
 * @property string $timezone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SpotFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Spot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Spot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Spot query()
 * @method static \Illuminate\Database\Eloquent\Builder|Spot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spot whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spot whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spot whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spot whereOptimalWindDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spot whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spot whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Spot extends Model
{
    use HasFactory;

    protected $casts = [
        'optimal_wind_direction' => 'integer',
    ];
}
