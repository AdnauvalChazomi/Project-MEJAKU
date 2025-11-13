<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'notifiable_id',
        'notifiable_type',
        'reservation_id',
        'title',
        'message',
        'type',
        'read',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    public function markAsRead()
    {
        $this->update(['read' => true]);
    }

    public static function forOwner($ownerId, $title, $message = null, $type = 'info', $reservationId = null)
    {
        return self::create([
            'notifiable_id' => $ownerId,
            'notifiable_type' => 'App\Models\Owner',
            'reservation_id' => $reservationId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
        ]);
    }

    public static function forCustomer($customerId, $title, $message = null, $type = 'info', $reservationId = null)
    {
        return self::create([
            'notifiable_id' => $customerId,
            'notifiable_type' => 'App\Models\Customer',
            'reservation_id' => $reservationId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
        ]);
    }
}
