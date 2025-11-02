<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Owner (pemilik restoran)
        $owner = User::create([
            'name' => 'John Owner',
            'email' => 'owner@example.com',
            'no_hp' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        // Customer (pelanggan)
        $customer = User::create([
            'name' => 'Jane Customer',
            'email' => 'customer@example.com',
            'no_hp' => '089876543210',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Tambah beberapa user random
        User::factory()->count(5)->create();
    }
}
