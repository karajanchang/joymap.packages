<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberBonus extends Model
{
    use HasFactory;

    protected $table = 'member_bonus';

    protected $guarded  = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function paylog()
    {
        return $this->belongsTo(PayLog::class);
    }
}
