<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationMemberWithdraw extends Model
{
    use HasFactory;

    protected $table = 'notification_member_withdraw';

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
