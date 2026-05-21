<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Models\Spot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\AbstractFeatureTestCase;

final class SpotsForecastTest extends AbstractFeatureTestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_does_not_have_n_plus_one_queries_on_forecast_endpoint(): void
    {
        Cache::flush();
        $spot = Spot::factory()->create();

        // Mock StormGlass API
        Http::fake([
            'https://api.stormglass.io/v2/weather/point*' => Http::response([
                'hours' => array_map(fn ($i) => [
                    'time' => now()->addHours($i)->toIso8601String(),
                    'airTemperature' => ['noaa' => 20],
                    'cloudCover' => ['noaa' => 50],
                    'waterTemperature' => ['noaa' => 15],
                    'windSpeed' => ['noaa' => 5],
                    'windDirection' => ['noaa' => 180],
                    'swellHeight' => ['noaa' => 1.5],
                    'swellPeriod' => ['noaa' => 10],
                ], range(0, 23)),
            ], 200),
            'https://api.stormglass.io/v2/tide/extremes/point*' => Http::response([
                'data' => [],
            ], 200),
        ]);

        DB::flushQueryLog();
        DB::enableQueryLog();

        $response = $this->getJson("/api/spots/{$spot->id}/forecast");

        $response->assertStatus(200);

        $queries = DB::getQueryLog();
        $queryCount = count($queries);

        // We expect:
        // 1. SELECT * FROM spots WHERE id = ?
        // 2. SELECT * FROM forecasts WHERE spot_id = ? AND time < ? AND time > ? ORDER BY time DESC LIMIT 1
        // 3. For each hour (24): SELECT * FROM forecasts WHERE spot_id = ? AND time = ? LIMIT 1
        // 4. For each hour (24): INSERT INTO forecasts ... (or UPDATE if exists, but here it's empty)
        // Total expected if unoptimized: 1 + 1 + 24 + 24 = 50 queries (approx)

        $this->assertLessThan(10, $queryCount, "Too many queries detected: {$queryCount}");
    }
}
