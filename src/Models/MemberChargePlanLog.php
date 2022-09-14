<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberChargePlanLog extends Model
{
    use HasFactory;

    protected $table = "member_charge_plan_log";

    public $timestamps = ["created_at"];

    const UPDATED_AT = null;

    protected $guarded  = [];

    public function memberChargePlan()
    {
        return $this->belongsTo(MemberChargePlan::class);
    }
}
