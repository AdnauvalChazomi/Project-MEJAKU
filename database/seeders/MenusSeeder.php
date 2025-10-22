<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel menus.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'owner_id' => 1,
                'nama' => 'Nasi Goreng Spesial',
                'deskripsi' => 'Nasi goreng dengan telur, ayam, dan sayuran segar.',
                'harga' => 25000,
                'foto' => 'images/menu/placeholder.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => 1,
                'nama' => 'Mie Ayam Bakso',
                'deskripsi' => 'Mie ayam dengan tambahan bakso sapi kenyal.',
                'harga' => 20000,
                'foto' => 'images/menu/placeholder.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => 1,
                'nama' => 'Es Teh Manis',
                'deskripsi' => 'Minuman segar teh manis dingin.',
                'harga' => 8000,
                'foto' => 'images/menu/placeholder.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
