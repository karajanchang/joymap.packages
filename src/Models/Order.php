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
}
