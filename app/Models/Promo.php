<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'kode',
        'nama_promo',
        'tipe_diskon',
        'nilai_diskon',
        'tanggal_mulai',
        'tanggal_selesai',
        'batas_penggunaan',
        'digunakan',
        'aktif',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
