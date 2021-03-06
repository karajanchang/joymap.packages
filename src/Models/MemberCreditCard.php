<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberCreditCard extends Model
{
    use HasFactory;

    protected $table = 'member_credit_card';

    public $timestamps = true;

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
