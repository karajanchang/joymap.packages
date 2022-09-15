<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\MemberFactory::new();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tagSettings()
    {
        return $this->hasMany(MemberTagSetting::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function notificationOrder()
    {
        return $this->hasMany(NotificationOrder::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function memberDeviceTokens()
    {
        return $this->hasMany(MemberPush::class, 'member_id', 'id');
    }

    public function memberRelation()
    {
        return $this->hasOne(MemberRelation::class);
    }

    public function relationChildren()
    {
        return $this->hasMany(MemberRelation::class, 'parent_member_id', 'id');
    }

    public function relationGrandChildren()
    {
        return $this->hasMany(MemberRelation::class, 'grand_parent_member_id', 'id');
    }

    public function memberBonuses()
    {
        return $this->hasMany(MemberBonus::class, 'member_id', 'id');
    }

    public function memberBank()
    {
        return $this->hasOne(MemberBank::class);
    }

    public function deleteLogs()
    {
        return $this->hasMany(MemberDeleteLog::class, 'member_id', 'id');
    }

    public function jcUser()
    {
        return $this->hasOne(JcUser::class);
    }

    public function chargePlans()
    {
        return $this->belongsToMany(ChargePlan::class, 'member_charge_plan','member_id','charge_plan_id')->withPivot('status','receiver','receiver_phone','receiver_address');
    }

    public function memberChargePlans()
    {
        return $this->hasMany(MemberChargePlan::class);
    }

    public function memberLoginLogs()
    {
        return $this->hasMany(MemberLoginLog::class);
    }

    /**
     * chargePlanEligible
     * 是否有開通樂粉回饋方案
     * @return void
     */
    public function chargePlanEligible()
    {
        $needle = [1]; //樂粉回饋方案 ID
        $memberChargePlans = $this->memberChargePlans();
        foreach ($needle as $chargePlanId) {
            if ($memberChargePlans->where('charge_plan_id', $chargePlanId)->where('status', 2)->exists()) {
                return true;
            }
        }
        return false;
    }
}
