<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public $timestamps = true;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\OrderFactory::new();
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function tagSettings()
    {
        return $this->hasMany(OrderTagSetting::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function timeLogs()
    {
        return $this->hasOne(OrderTimeLog::class);
    }

    public function notificationOrder()
    {
        return $this->hasMany(NotificationOrder::class);
    }

    public function orderTags()
    {
        return $this->belongsToMany(\App\Models\StoreTag::class, 'order_tag_settings', 'order_id', 'store_tag_id');
    }

    public function storeNotification()
    {
        return $this->hasMany(\App\Models\StoreNotification::class);
    }

    /**
     * 會是抓全部店家的會員標籤，要再 where store_id
     * @return mixed
     */
    public function memberTags()
    {
        return $this->belongsToMany(StoreTag::class, 'member_tag_settings', 'member_id', 'store_tag_id', 'member_id');
    }
}
