<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<10; $i++)
        {
            Product::create([
                'title' => "Product-". $i,
                'price' => rand(1000, 3444),
                'quantity' => rand(3, 100),
                'publish' => true,
                'user_id' => rand(1, 10),
                'description' => "bla  bla",
                'slug' => Str::slug("Product-". $i)
            ]);
        }
    }
}
