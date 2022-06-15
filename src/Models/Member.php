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

    public function memberBonuses()
    {
        return $this->hasMany(MemberBonus::class, 'member_id', 'id');
    }

    public function memberBank()
    {
        return $this->hasOne(MemberBank::class);
    }
}
