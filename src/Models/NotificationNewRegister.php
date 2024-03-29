<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationNewRegister extends Model
{
    use HasFactory;

    protected $table = 'notification_new_register';

    protected $guarded = [];

    public function getMorphClass()
    {
        return $this->getTable();
    }

    public function notify()
    {
        return $this->morphOne(Notification::class, 'notify');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
