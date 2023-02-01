<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlockOrderHour extends Model
{
    use HasFactory;

    protected $table = 'block_order_hour';

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
