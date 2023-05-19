<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberDealerPointWithdraw extends Model
{
    use HasFactory;

    protected $table = 'member_dealer_point_withdraws';

    protected $guarded = [];

    public function memberDealerPointLog()
    {
        return $this->belongsTo(MemberDealerPointLog::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

}
