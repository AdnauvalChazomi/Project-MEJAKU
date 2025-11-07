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
        'jam_buka',
        'jam_tutup',
        'area',
        'kategori_layanan',
    ];

    protected $casts = [
        'area' => 'array',
        'kategori_layanan' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function getJamBukaAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    public function getJamTutupAttribute($value)
    {
        return date('H:i', strtotime($value));
    }
}
