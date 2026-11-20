<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Webcam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WebcamsControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function get_webcams_should_return_200(): void
    {
        $response = $this->get('/webcams');

        $response->assertOk();
    }

    #[Test]
    public function api_filters_webcams_when_a_coordinate_is_zero(): void
    {
        foreach ([[0, 10], [10, 0], [0, 0]] as [$lat, $lng]) {
            Webcam::query()->delete();
            $nearby = Webcam::factory()->create(['lat' => $lat + 0.02, 'lng' => $lng + 0.02]);
            $distant = Webcam::factory()->create(['lat' => $lat + 1, 'lng' => $lng + 1]);

            $this->getJson("/api/webcams?lat={$lat}&lng={$lng}")
                ->assertOk()
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.id', $nearby->id)
                ->assertJsonMissing(['id' => $distant->id]);
        }
    }

    #[Test]
    public function api_returns_all_webcams_without_a_coordinate_pair(): void
    {
        Webcam::factory()->count(2)->create();

        $this->getJson('/api/webcams')->assertOk()->assertJsonCount(2, 'data');
        $this->getJson('/api/webcams?lat=0')->assertOk()->assertJsonCount(2, 'data');
    }

    #[Test]
    public function api_rejects_invalid_coordinates(): void
    {
        foreach (['lat=abc&lng=0' => 'lat', 'lat=91&lng=0' => 'lat', 'lat=0&lng=-181' => 'lng'] as $query => $field) {
            $this->getJson('/api/webcams?'.$query)->assertUnprocessable()->assertJsonValidationErrors($field);
        }
    }
}
