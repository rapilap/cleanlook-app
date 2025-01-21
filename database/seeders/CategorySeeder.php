<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['cat_name'=>'Organik', 'cat_price'=>3000],
            ['cat_name'=>'Non Organik', 'cat_price'=>3000],
            ['cat_name'=>'B3', 'cat_price'=>5000],
        ];

        DB::table('categories')->insert($categories);
    }
}
