<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlans extends Model
{
    use HasFactory;

    protected $table = 'pricing_plans';

    protected $fillable = [
        'type',
        'nama_paket',
        'harga',
        'deskripsi',
    ];

    public static function getByType(string $type): ?self
    {
        return self::where('type', $type)->first();
    }

    public function getHargaFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
