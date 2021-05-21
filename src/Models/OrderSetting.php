<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderSetting extends Model
{
    use HasFactory;

    protected $table = 'order_settings';

    public $timestamps = false;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\OrderSettingFactory::new();
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
