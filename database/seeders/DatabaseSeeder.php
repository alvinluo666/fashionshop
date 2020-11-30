<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        // Product::factory(100)->create();
        // ProductType::factory(10)->create();
        // ProductCategory::factory(3)->create();
        Review::factory(500)->create();
    }
}
