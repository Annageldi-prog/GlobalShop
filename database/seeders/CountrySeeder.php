<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'Russia', 'currency' => 'RUB', 'symbol' => '₽', 'rate' => 1],
            ['name' => 'Turkey', 'currency' => 'TRY', 'symbol' => '₺', 'rate' => 15],
            ['name' => 'USA', 'currency' => 'USD', 'symbol' => '$', 'rate' => 0.013],
            ['name' => 'Germany', 'currency' => 'EUR', 'symbol' => '€', 'rate' => 0.012],
        ];

        foreach ($countries as $c) {
            Country::updateOrCreate(
                ['name' => $c['name']],
                [
                    'currency' => $c['currency'],
                    'symbol' => $c['symbol'],
                    'rate' => $c['rate'],
                ]
            );
        }
    }
}
