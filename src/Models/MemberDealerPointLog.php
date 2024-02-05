<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberDealerPointLog extends Model
{
    use HasFactory;

    protected $table = 'member_dealer_point_logs';

    protected $guarded = [];

    public function memberDealer()
    {
        return $this->belongsTo(MemberDealer::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function memberDealerPointWithdraw()
    {
        return $this->hasOne(MemberDealerPointWithdraw::class);
    }

    public function subscriptionProgramOrder()
    {
        return $this->belongsTo(SubscriptionProgramOrder::class);
    }

    public function childMemberDealer()
    {
        return $this->belongsTo(MemberDealer::class, 'child_dealer_id', 'id');
    }

}
