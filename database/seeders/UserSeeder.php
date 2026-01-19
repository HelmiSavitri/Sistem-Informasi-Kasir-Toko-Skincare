<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kasir (opsional, bisa kamu hapus kalau tidak perlu)
        User::create([
            'name' => 'Kasir Toko',
            'email' => 'kasir@lovebeauty.com',
            'password' => Hash::make('kasir'),
        ]);
    }
}
