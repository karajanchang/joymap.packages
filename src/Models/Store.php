<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
    use HasFactory;

    // protected static function newFactory()
    // {
    //     return \Joymap\database\factories\StoreFactory::new();
    // }

    protected $table = 'stores';

    public $timestamps = true;

    protected $guarded = ['id'];

    public function getLatLngAttribute()
    {
        $id =  $this->attributes['id'];

        return DB::table('stores')->find($id, array(DB::raw('ST_AsText(lat_lng) AS lat_lng')))->lat_lng;
    }

    public function restriction()
    {
        return $this->belongsTo(StoreRestriction::class, 'store_restriction_id', 'id');
    }

    public function roles()
    {
        return $this->hasMany(StoreRole::class);
    }

    public function notifications()
    {
        return $this->hasMany(StoreNotification::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderSettings()
    {
        return $this->hasOne(OrderSetting::class);
    }

    public function images()
    {
        return $this->hasMany(StoreImage::class);
    }

    public function serviceSettings()
    {
        return $this->hasMany(StoreServiceSetting::class);
    }

    public function replies()
    {
        return $this->hasMany(StoreReplie::class);
    }

    public function users()
    {
        return $this->hasMany(StoreUser::class);
    }

    public function specialBusinessTimes()
    {
        return $this->hasMany(SpecialStoreBusinessTime::class);
    }

    public function businessTimes()
    {
        return $this->hasMany(StoreBusinessTime::class);
    }

    public function storeFoodTypes()
    {
        return $this->hasMany(StoreFoodType::class);
    }

    public function userPasswordValidates()
    {
        return $this->hasMany(StoreUserPasswordValidate::class);
    }

    public function storePayments()
    {
        return $this->hasMany(StorePayment::class);
    }

    public function tags()
    {
        return $this->hasMany(StoreTag::class);
    }

    public function orderHourSettings()
    {
        return $this->hasMany(OrderHourSetting::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function announcementLogs()
    {
        return $this->hasMany(StoreAnnouncementLog::class);
    }

    public function foodTypes()
    {
        return $this->belongsToMany(FoodType::class, 'store_food_types', 'store_id', 'food_type_id');
    }

    public function storeService()
    {
        return $this->belongsToMany(StoreService::class, 'store_service_settings', 'store_id', 'store_service_id')->withPivot('status');
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'store_payments', 'store_id', 'payment_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function activeTags()
    {
      return $this->belongsToMany(Tag::class, 'tag_settings');
    }

    public function storeSpgateway()
    {
        return $this->hasOne(StoreSpgateway::class);
    }

    public function ranking()
    {
        return $this->hasOne(Ranking::class);
    }

    public function notificationStorePay()
    {
        return $this->hasOne(NotificationStorePay::class);
    }

    public function storeFloors()
    {
        return $this->hasMany(\App\Models\StoreFloor::class);
    }

    public function storeTableCombinations()
    {
        return $this->hasMany(\App\Models\StoreTableCombination::class);
    }

    public function tables()
    {
        return $this->hasManyThrough(\App\Models\StoreTable::class, \App\Models\StoreFloor::class);
    }

    public function blockOrderHour()
    {
        return $this->hasMany(\App\Models\BlockOrderHour::class);
    }

    public function canOrderTimes()
    {
        return $this->hasMany(\App\Models\CanOrderTime::class);
    }

    public function wallet()
    {
        return $this->hasMany(\App\Models\Wallet::class);
    }

    public function memberDealerRecommendStore()
    {
        return $this->hasOne(MemberDealerRecommendStore::class);
    }
}
