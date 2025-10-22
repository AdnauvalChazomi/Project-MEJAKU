<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoMenu extends Model
{
    use HasFactory;

    protected $table = 'foto_menu';

    protected $fillable = [
        'owner_id',
        'url',
    ];

    /**
     * Relasi ke Owner
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
}
