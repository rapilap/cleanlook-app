<?php

namespace Database\Factories;

use App\Models\Landfill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Landfill>
 */
class LandfillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Landfill::class;

    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'address'=>fake()->address(),
            'capacity'=>fake()->numberBetween(1000,100000),
            'latitude'=>fake()->latitude(-6.95, -6.85),
            'longitude'=>fake()->longitude(107.55, 107.75),
        ];
    }
}
