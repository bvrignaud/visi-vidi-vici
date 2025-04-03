<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Spot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Spot>
 */
class SpotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Spot::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'lng' => $this->faker->longitude(),
            'lat' => $this->faker->latitude(),
            'optimal_wind_direction' => rand(0, 360),
            'timezone' => $this->faker->timezone,
        ];
    }
}
