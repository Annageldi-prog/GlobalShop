<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'name' => 'Annageldi',
            'password' => bcrypt('shop2026'), // обязательно bcrypt
            'is_admin' => true,
        ]);


        $this->call([
            CountrySeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            SeasonsSeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,
        ]);

    }
}
