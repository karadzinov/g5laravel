<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Webpatser\Countries\CountriesServiceProvider;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       //  $this->call(RoleSeeder::class);
       //  $this->call(ProductSeeder::class);
       //  \App\Models\User::factory(10)->create();

        Product::factory(20)->create();

      //  $this->call(CountriesSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
