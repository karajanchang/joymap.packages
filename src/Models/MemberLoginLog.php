<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberLoginLog extends Model
{
    use HasFactory;

    protected $table = 'member_login_log';

    protected $guarded = [];

    public $timestamps = ["created_at"];

    const UPDATED_AT = null;

    protected $casts = [
        'origin_request_header' => 'array'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
