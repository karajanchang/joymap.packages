<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationPlatform extends Model
{
    use HasFactory;

    protected $table = 'notification_platform';

    protected $guarded = [];

    public function notify()
    {
        return $this->morphOne(Notification::class, 'notify');
    }
}
