<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Cleanser'],          // Sabun wajah
            ['name' => 'Toner'],             // Penyegar
            ['name' => 'Serum'],             // Serum wajah
            ['name' => 'Moisturizer'],       // Pelembab
            ['name' => 'Sunscreen'],         // Tabir surya
            ['name' => 'Face Mask'],         // Masker wajah
            ['name' => 'Lip Care'],          // Perawatan bibir
            ['name' => 'Body Care'],         // Body lotion dll
            ['name' => 'Hair Care'],         // Shampoo dll
            ['name' => 'Makeup'],            // Makeup ringan
        ]);
    }
}
