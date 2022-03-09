<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberLoginLog extends Model
{
    use HasFactory;

    protected $table = 'member_login_log';

    protected $guarded = [];

    public $timestamps = ["created_at"];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
