<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user dengan role 'customer'
        $customerUser = User::where('role', 'customer')->first();

        if ($customerUser) {
            Customer::create([
                'user_id' => $customerUser->id,
                'foto_profil' => 'images/profile/2.png',
                'alamat' => 'Jl. Anggrek No. 12, Jakarta',
                'summary' => 'Pecinta kuliner nusantara.',
            ]);
        }
    }
}
