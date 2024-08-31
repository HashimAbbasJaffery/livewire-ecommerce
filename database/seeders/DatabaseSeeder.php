<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Image;
use App\Models\Category;
use App\Models\Color;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        $product = Product::factory(50)->create();


        for($i = 0; $i < 50; $i++) {
            Image::factory()
                    ->count(1)
                    ->for($product->random())
                    ->create();

            Category::factory(10)->create();
        }
        Color::factory(50)->create();
    }
}
