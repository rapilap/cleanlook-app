<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Courier;
use App\Models\Landfill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\Transaction::class;

    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $courier = Courier::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();
        $landfill = Landfill::inRandomOrder()->first();
        $weight = fake()->numberBetween(1,10);

        return [
            'user_id'=>$user->id,
            'courier_id'=>$courier->id,
            'category_id'=>$category->id,
            'landfill_id'=>$landfill->id,
            'pickup_lat'=>fake()->latitude(-6.95, -6.85),
            'pickup_long'=>fake()->longitude(107.55, 107.75),
            "weight"=>$weight,
            'price'=>$weight * $category->cat_price,
            'status'=>$this->faker->randomElement(['pending', 'accepted', 'completed', 'canceled']),
        ];
    }
}
