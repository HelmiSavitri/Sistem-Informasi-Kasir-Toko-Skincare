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
        Product::create([
            'unique_code' => 'PRD-0001',
            'name' => 'Skintific 5x Ceramide Skin Barrier',
            'category_id' => 1,
            'brand_id' => 1,
            'price' => 50000,
            'stock' => 10,
        ]);

        Product::create([
            'unique_code' => 'PRD-0002',
            'name' => 'Some By Mi Snail Truecica Miracle Repair Cream',
            'category_id' => 1,
            'brand_id' => 2,
            'price' => 65000,
            'stock' => 15,
        ]);

        Product::create([
            'unique_code' => 'PRD-0003',
            'name' => 'COSRX Advanced Snail 96 Mucin Power Essence',
            'category_id' => 2,
            'brand_id' => 3,
            'price' => 75000,
            'stock' => 20,
        ]);
    }
}
