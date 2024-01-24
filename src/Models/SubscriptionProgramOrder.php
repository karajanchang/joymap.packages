<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionProgramOrder extends Model
{
    use HasFactory;

    protected $table = 'subscription_program_orders';

    protected $guarded = [];

    public function subscriptionProgram()
    {
        return $this->belongsTo(SubscriptionProgram::class);
    }

    public function subscriptionProgramPayLog()
    {
        return $this->belongsTo(SubscriptionProgramPayLog::class);
    }

    public function memberDealer()
    {
        return $this->belongsTo(MemberDealer::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function memberDealerPointLog()
    {
        return $this->hasOne(MemberDealerPointLog::class);
    }
}
