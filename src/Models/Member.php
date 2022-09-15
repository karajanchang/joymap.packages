<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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

    /**
     * firstOpenChargePlanTime
     * 第一次樂粉回饋開通時間
     * @return void
     */
    public function firstOpenChargePlanTime()
    {
        $sub = DB::table(function ($query) {
            $query->from('member_charge_plan')
                ->select('id', 'member_id', 'charge_plan_id')
                ->where('status', 2);
        }, 'member_charge_plan')
            ->leftJoinSub(function ($query) {
                $query->from('member_charge_plan_log')
                    ->select('member_charge_plan_id', 'type', 'created_at')
                    ->where('type', 2);
            }, 'member_charge_plan_log', 'member_charge_plan_log.member_charge_plan_id', '=', 'member_charge_plan.id')
            ->select([
                'member_charge_plan.member_id as member_id',
            ])
            ->selectRaw("MIN(member_charge_plan_log.created_at) as first_open_member_charge_plan_created_at")
            ->groupBy('member_charge_plan.member_id');

        return $this->from('members as members')
            ->leftJoinSub($sub, 'mcp', 'mcp.member_id', '=', 'members.id')
            ->where('members.id', $this->id)
            ->select([
                'mcp.first_open_member_charge_plan_created_at'
            ])
            ->first()
            ->first_open_member_charge_plan_created_at ?? null;
    }
}
