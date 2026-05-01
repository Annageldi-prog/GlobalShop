<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Country;
use App\Models\RegionalPrice;

class RegionalPriceSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $countries = Country::all();

        foreach ($products as $product) {
            foreach ($countries as $country) {

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