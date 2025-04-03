<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\WebcamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webcam extends Model
{
    /** @use HasFactory<WebcamFactory> */
    use HasFactory;
}
