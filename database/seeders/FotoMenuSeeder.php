<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FotoMenuSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        DB::table('foto_menu')->insert([
            [
                'owner_id' => 1,
                'url' => 'images/foto_menu/1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
