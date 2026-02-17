<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seasons;

class SeasonsSeeder extends Seeder
{
    public function run(): void
    {
        $seasons = ['Winter', 'Spring', 'Summer', 'Autumn'];

        foreach ($seasons as $s) {
            Seasons::updateOrCreate(['name' => $s]);
        }
    }
}
