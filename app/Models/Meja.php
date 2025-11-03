<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'nomor', 'status'];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
}
