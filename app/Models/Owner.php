<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_restoran',
        'alamat_restoran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'owner_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'owner_id', 'id');
    }

    public function fotoMenus() {
    return $this->hasMany(FotoMenu::class, 'owner_id');
}
}
