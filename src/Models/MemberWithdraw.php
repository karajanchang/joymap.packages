<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberWithdraw extends Model
{
    use HasFactory;

    protected $table = "member_withdraw";

    protected $guarded  = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
