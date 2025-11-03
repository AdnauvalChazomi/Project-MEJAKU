<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operational extends Model
{
    use HasFactory;

    protected $table = 'operational';

    protected $fillable = [
        'owner_id',
        'hari',
        'jam_buka',
        'jam_tutup',
        'area',
        'jumlah_meja',
        'jumlah_kursi',
        'kategori_layanan',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
}
