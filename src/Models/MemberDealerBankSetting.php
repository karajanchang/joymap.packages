<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberDealerBankSetting extends Model
{
    use HasFactory;

    protected $table = 'member_dealer_bank_settings';

    protected $guarded = [];

    public function memberDealer()
    {
        return $this->belongsTo(MemberDealer::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

}
