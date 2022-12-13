<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Webcams
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property float $lng
 * @property float $lat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams query()
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webcams whereUrl($value)
 * @mixin \Eloquent
 */
class Webcams extends Model
{
    use HasFactory;
}
