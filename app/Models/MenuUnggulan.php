<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuUnggulan extends Model
{
    use HasFactory;

    protected $table = 'menu_unggulan';

    protected $fillable = [
        'menu_id',
        'owner_id',
        'is_active',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
