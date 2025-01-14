<?php

namespace Database\Seeders;

use App\Models\Landfill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandfillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Landfill::factory(10)->create();
    }
}
