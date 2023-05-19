<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouponNumber extends Model
{
    use HasFactory;

    protected $table = 'coupon_numbers';

    protected $guarded = [];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function memberDealer()
    {
        return $this->belongsTo(MemberDealer::class);
    }

    public function couponNumberTransactionLogs()
    {
        return $this->hasMany(CouponNumberTransactionLog::class);
    }

}
