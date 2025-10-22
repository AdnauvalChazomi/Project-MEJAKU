<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'owner_id',
        'nama',
        'deskripsi',
        'harga',
        'foto',
    ];

    /**
     * Relasi: satu menu dimiliki oleh satu owner.
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
}
