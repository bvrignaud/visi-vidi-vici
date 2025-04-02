<?php

declare(strict_types=1);

namespace App\Http\Controllers;

trait SpotTrait
{
    /**
     * @param  float  $windSpeed  Speed of wind at 10m above sea level in meters per second.
     * @return float note between -1 and 1
     */
    private function calculNoteForWind(float $bestWindDirection, float $windDirection, float $windSpeed): float
    {
        $e = abs($bestWindDirection - $windDirection) % 360;
        $note = (90 - $e) / 90;

        return $note * $windSpeed / 20;
    }

    private function calculNoteForSwell(float $swell): float
    {
        return 0.5 - $swell;
    }

    private function calculNoteForSwellPeriod(float $swellPeriod): float
    {
        return 9 - $swellPeriod;
    }
}
