<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store_tags';

    public $timestamps = true;

    protected $guarded = [];

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
