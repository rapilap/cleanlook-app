<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'address'=>fake()->address(),
            'capacity'=>fake()->numberBetween(1000,100000),
            'latitude'=>fake()->latitude(),
            'longitude'=>fake()->longitude(),
        ];
    }
}
