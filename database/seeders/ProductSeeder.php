<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {
            Product::Create([
                'name' => "product" . $i,
                'description' => "desc" . $i,
                'price' => rand(100, 750),
                'vendor_id' => rand(1, 5)
            ]);
        }
    }
}
