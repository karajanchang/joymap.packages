<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionProgramPayLog extends Model
{
    use HasFactory;

    protected $table = 'subscription_program_pay_logs';

    protected $guarded = [];

    public function memberDealer()
    {
        return $this->belongsTo(MemberDealer::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
