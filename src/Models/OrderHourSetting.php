<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderHourSetting extends Model
{
    use HasFactory;

    protected $table = 'order_hour_settings';

    public $timestamps = false;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\OrderHourSettingFactory::new();
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
