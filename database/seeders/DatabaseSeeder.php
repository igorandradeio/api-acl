<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Cache::forget('categories');

        $category = Category::factory()->create();

        Product::factory()->count(10)->create([
            'category_id' => $category->id
        ]);

        $this->call(ResourceSeeder::class);
    }
}
