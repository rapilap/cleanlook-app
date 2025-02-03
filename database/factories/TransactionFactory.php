<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Courier;
use App\Models\Landfill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TransactionFactory extends Factory
{
    protected $model = \App\Models\Transaction::class;

    // Inisialisasi tanggal awal (misalnya mulai dari 1 Januari 2023)
    private static $dateCounter;

    public function definition(): array
    {
        if (is_null(self::$dateCounter)) {
            self::$dateCounter = Carbon::create(2023, 1, 1);
        } else {
            self::$dateCounter->addDay(); // Tambah 1 hari setiap transaksi baru
        }

        $user = User::inRandomOrder()->first();
        $courier = $this->faker->randomElement([null, Courier::inRandomOrder()->first()?->id]);
        $category = Category::inRandomOrder()->first();
        $landfill = Landfill::inRandomOrder()->first();
        $weight = fake()->numberBetween(1, 10);

        return [
            'user_id' => $user->id,
            'courier_id' => $courier,
            'category_id' => $category->id,
            'landfill_id' => $landfill->id,
            'date' => self::$dateCounter->toDateString(), // Pastikan tanggalnya berurutan
            'pickup_lat' => fake()->latitude(-6.95, -6.85),
            'pickup_long' => fake()->longitude(107.55, 107.75),
            'address' => fake()->address(),
            'weight' => $weight,
            'price' => $weight * $category->cat_price,
            'status' => $courier == null
                ? $this->faker->randomElement(['unpaid', 'searching'])
                : $this->faker->randomElement(['pickup', 'deliver', 'completed', 'canceled'])
        ];
    }
}
