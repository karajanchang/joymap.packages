<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberChargePlan extends Model
{
    use HasFactory;

    protected $table = "member_charge_plan";

    protected $guarded  = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function chargePlan()
    {
        return $this->belongsTo(ChargePlan::class);
    }

    public function memberChargePlanlogs()
    {
        return $this->hasMany(MemberChargePlanLog::class);
    }
}
