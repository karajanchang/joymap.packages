<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionProgramCreditcardLog extends Model
{
    use HasFactory;

    protected $table = 'subscription_program_creditcard_logs';

    protected $guarded = [];

    public function subscriptionProgramPayLog()
    {
        return $this->belongsTo(SubscriptionProgramPayLog::class);
    }
}
