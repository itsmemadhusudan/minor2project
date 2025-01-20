<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $imagePaths = [
            'product_images/xylHiLoCIJn0qzJGt09JzPPEbF3UhNriG6UNVFby.png',
            'product_images/C8FkQYEDqmQ0HT19f6V9J0zfsxkaUA5dHFxSSCAm.png',
            'product_images/p7S5Q12Peh4xYFC736ayu4LA7ge4GV9B4iZsIXOy.png',
        ];
        $categories = [
            'Traditional',
            'Western'
        ];
        DB::table('products')->delete();
        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'name' => $faker->words(3, true),
                'description' => $faker->optional()->paragraph(),
                'price' => $faker->randomFloat(2, 10, 500),
                'category' => $faker->randomElement($categories),
                'added_by' => 3, // Fixed user ID
                'image' => $faker->optional()->randomElement($imagePaths),
            ]);
        }
    }
}