<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberDealer extends Model
{
    use HasFactory;

    protected $table = 'member_dealers';

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function memberDealerRelation()
    {
        return $this->hasOne(MemberDealerRelation::class);
    }

    public function memberDealerBankSetting()
    {
        return $this->hasOne(MemberDealerBankSetting::class);
    }

    public function memberDealerPointLogs()
    {
        return $this->hasMany(MemberDealerPointLog::class);
    }

    public function couponNumbers()
    {
        return $this->hasMany(CouponNumber::class);
    }

    public function memberDealerRecommendStores()
    {
        return $this->hasMany(MemberDealerRecommendStore::class);
    }

    public function memberDealerBonuses()
    {
        return $this->hasMany(MemberDealerBonus::class);
    }

    public function memberDealerBonusWithdraws()
    {
        return $this->hasMany(MemberDealerBonusWithdraw::class);
    }

    public function memberBanks()
    {
        return $this->hasMany(MemberBank::class, 'member_id', 'member_id');
    }

    public function subscriptionProgram()
    {
        return $this->belongsTo(SubscriptionProgram::class);
    }

    public function nextSubscriptionProgram()
    {
        return $this->belongsTo(SubscriptionProgram::class, 'next_subscription_program_id', 'id');
    }

    public function subscriptionProgramOrders()
    {
        return $this->hasMany(SubscriptionProgramOrder::class);
    }

    public function subscriptionProgramPayLogs()
    {
        return $this->hasMany(SubscriptionProgramPayLog::class);
    }

    public function fromInviteDealer()
    {
        return $this->belongsTo(MemberDealer::class, 'from_invite_id', 'id');
    }

    public function inviteChildrens()
    {
        return $this->hasMany(MemberDealer::class, 'from_invite_id', 'id');
    }
}
