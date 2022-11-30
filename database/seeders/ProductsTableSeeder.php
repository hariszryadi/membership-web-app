<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'category' => 'Basic',
                'duration' => 1,
                'price' => 50000
            ],
            [
                'category' => 'Middle',
                'duration' => 3,
                'price' => 130000
            ],
            [
                'category' => 'Advance',
                'duration' => 6,
                'price' => 250000
            ]
        ]);
    }
}
