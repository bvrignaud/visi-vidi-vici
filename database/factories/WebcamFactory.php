<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Webcam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Webcam>
 */
class WebcamFactory extends Factory
{
    protected $model = Webcam::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'url' => $this->faker->url(),
            'lng' => $this->faker->longitude(),
            'lat' => $this->faker->latitude(),
        ];
    }
}
