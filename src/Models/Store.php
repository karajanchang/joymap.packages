<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected static function newFactory()
    {
        return \Joymap\database\factories\StoreFactory::new();
    }

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
        return $this->belongsTo(StoreRestriction::class);
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
        return $this->hasMany(OrderSetting::class);
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

    public function foodTypes()
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
}