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
}
