<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouponNumberTransactionLog extends Model
{
    use HasFactory;

    protected $table = 'coupon_number_transaction_logs';

    protected $guarded = [];

    public function couponNumber()
    {
        return $this->belongsTo(CouponNumber::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function memberDealer()
    {
        return $this->belongsTo(MemberDealer::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function payLog()
    {
        return $this->belongsTo(PayLog::class);
    }

}
