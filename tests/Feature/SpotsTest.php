<?php

namespace Tests\Feature;

use App\Models\Spot;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class SpotsTest extends AbstractFeatureTestCase
{
    use WithFaker;

    /** @test */
    public function get_spot_should_return_200(): void
    {
        $response = $this->get(route('spots.show', ['spot' => Spot::inRandomOrder()->first()]));
        $response->assertStatus(200);
    }

    /** @test */
    public function get_create_spot(): void
    {
        $response = $this->get(route('spots.create'));
        $response->assertStatus(302);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('spots.create'));
        $response->assertStatus(200);
    }

    /** @test */
    public function store_spot(): void
    {
        $spotCount = Spot::count();
        $response = $this->actingAs(User::factory()->create())->post(route('spots.store'), [
            'name' => $this->faker->name,
            'lng' => $this->faker->longitude,
            'lat' => $this->faker->latitude,
            'optimal_wind_direction' => rand(0, 360),
        ]);
        $response->assertRedirect();
        $this->assertCount($spotCount + 1, Spot::all());
    }

    /** @test */
    public function  a_spot_can_be_updated() :void
    {
        $spot = Spot::factory()->create();
        $response = $this->actingAs(User::factory()->create())->patch(route('spots.update', $spot), [
            'name' => 'New name',
            'lng' => $this->faker->longitude,
            'lat' => $this->faker->latitude,
            'optimal_wind_direction' => rand(0, 360),
        ]);
        $response->assertRedirect();
        $spot->refresh();
        $this->assertEquals('New name', $spot->name);
    }
}
