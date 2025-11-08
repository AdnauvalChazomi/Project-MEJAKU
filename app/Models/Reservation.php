<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'owner_id',
        'meja_id',
        'tanggal_reservasi',
        'nomor_pesanan',
        'jam_reservasi',
        'jumlah_tamu',
        'area',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }
}
