<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationMemberRead extends Model
{
    use HasFactory;
    protected $primaryKey = null;

    public $incrementing = false;

    protected $table = 'notification_member_read';

    public $timestamps = ["created_at"];

    const UPDATED_AT = null;

    protected $guarded = [];
}
