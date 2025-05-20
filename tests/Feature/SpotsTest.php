<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Spot;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;

class SpotsTest extends AbstractFeatureTestCase
{
    use WithFaker;

    #[Test]
    public function get_spot_should_return_200(): void
    {
        $response = $this->get(route('spots.show', ['spot' => Spot::inRandomOrder()->first()]));
        $response->assertStatus(200);
    }

    #[Test]
    public function get_create_spot(): void
    {
        $response = $this->get(route('spots.create'));
        $response->assertStatus(302);

        $user = User::factory()->create(['is_admin' => true]);
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->get(route('spots.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function store_spot(): void
    {
        $spotCount = Spot::count();
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::factory()->create(['is_admin' => true]))->post(route('spots.store'), [
                'name' => $this->faker->name,
                'lng' => $this->faker->longitude,
                'lat' => $this->faker->latitude,
                'optimal_wind_direction' => rand(0, 360),
                'timezone' => $this->faker->timezone,
            ]);
        $response->assertRedirect();
        $this->assertCount($spotCount + 1, Spot::all());
    }

    #[Test]
    public function a_spot_can_be_updated(): void
    {
        $spot = Spot::factory()->create();
        $response = $this
            ->actingAs(User::factory()->create(['is_admin' => true]))
            ->patch(route('spots.update', $spot), [
                'name' => 'New name',
                'lng' => $this->faker->longitude,
                'lat' => $this->faker->latitude,
                'optimal_wind_direction' => rand(0, 360),
                'timezone' => $this->faker->timezone,
            ]);
        $response->assertRedirect();
        $spot->refresh();
        $this->assertEquals('New name', $spot->name);
    }
}
