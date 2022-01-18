<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationOrder extends Model
{
    use HasFactory;

    protected $table = 'notification_order';

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function notify()
    {
        return $this->morphOne(Notification::class, 'notify');
    }
}
