<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Seasons;
use App\Models\Country;
use App\Models\Size;
use App\Models\ProductVariant;
use App\Models\RegionalPrice;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Nike Air Max', 'base_price' => 120, 'description' => 'Спортивная обувь', 'gender' => 'man'],
            ['name' => 'Adidas Hoodie', 'base_price' => 80, 'description' => 'Тёплая толстовка', 'gender' => 'woman'],
            ['name' => 'Zara Jacket', 'base_price' => 150, 'description' => 'Стильная куртка', 'gender' => 'woman'],
            ['name' => 'LocalBrand T-Shirt', 'base_price' => 30, 'description' => 'Футболка на каждый день', 'gender' => 'boy'],
            ['name' => 'Nike Shorts', 'base_price' => 40, 'description' => 'Спортивные шорты', 'gender' => 'man'],
            ['name' => 'Adidas Cap', 'base_price' => 25, 'description' => 'Кепка для спорта', 'gender' => 'unisex'],
        ];

        foreach ($products as $p) {

            $product = Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'name' => $p['name'],
                    'base_price' => $p['base_price'],
                    'season_id' => Seasons::inRandomOrder()->first()?->id,
                    'description' => $p['description'],
                    'gender' => $p['gender'],
                    'category_id' => Category::inRandomOrder()->first()?->id,
                    'brand_id' => Brand::inRandomOrder()->first()?->id,
                ]
            );

            foreach (Size::all() as $size) {
                ProductVariant::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'size_id' => $size->id,
                    ],
                    [
                        'stock' => rand(5, 20),
                    ]
                );
            }

            foreach (Country::all() as $country) {
                RegionalPrice::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'country_id' => $country->id,
                    ],
                    [
                        'price' => round($product->base_price * ($country->rate ?? 1), 2),
                        'currency' => $country->currency ?? 'USD', 
                    ]
                );
            }
        }
    }
}