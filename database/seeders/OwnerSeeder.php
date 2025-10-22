<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\User;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user yang memiliki role 'owner'
        $ownerUser = User::where('role', 'owner')->first();

        if ($ownerUser) {
            Owner::create([
                'user_id' => $ownerUser->id,
                'nama_restoran' => 'Warung Sederhana',
                'alamat_restoran' => 'Jl. Merdeka No. 45, Bandung',
                'summary' => 'Restoran khas nusantara dengan cita rasa rumahan.',
                'lokasi_restoran' => '-6.914744,107.609810',
                'foto_restoran' => 'images/profile/1.png',
                'nib' => '1234567890',
            ]);
        }
    }
}
