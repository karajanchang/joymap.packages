<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreTag extends Model
{
    use HasFactory;

    protected $table = 'store_tags';

    public $timestamps = true;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\StoreTagFactory::new();
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function memberTagSettings()
    {
        return $this->hasMany(MemberTagSetting::class);
    }

    public function orderTagSettings()
    {
        return $this->hasMany(OrderTagSetting::class);
    }
}
