<?php

namespace Database\Seeders;

use App\Models\PricingPlans;
use Illuminate\Database\Seeder;
use App\Models\PricingPlan;

class PricingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'type' => 'activation',
                'nama_paket' => 'Aktivasi Akun Premium',
                'harga' => 50000,
                'deskripsi' => 'Aktivasi akun premium untuk fitur lengkap.',
            ],
            [
                'type' => 'monthly',
                'nama_paket' => 'Langganan Bulanan',
                'harga' => 100000,
                'deskripsi' => 'Akses premium selama 30 hari.',
            ],
            [
                'type' => 'yearly',
                'nama_paket' => 'Langganan Tahunan',
                'harga' => 200000,
                'deskripsi' => 'Akses premium selama 1 tahun penuh.',
            ],
        ];

        foreach ($plans as $plan) {
            PricingPlans::updateOrCreate(['type' => $plan['type']], $plan);
        }
    }
}
