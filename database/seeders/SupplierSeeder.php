<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT. Glow Beauty Indonesia',
                
                'phone' => '081234567890',
                'address' => 'Jl. Melati No. 12, Jakarta Selatan',
            ],
            [
                'name' => 'CV. Skincare Natural',
                
                'phone' => '081298765432',
                'address' => 'Jl. Kenanga No. 45, Bandung',
            ],
            [
                'name' => 'PT. Dermalab Nusantara',
                'phone' => '081355667788',
                'address' => 'Jl. Sudirman No. 88, Surabaya',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
