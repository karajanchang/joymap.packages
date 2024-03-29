<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StorePayRemindSetting extends Model
{
    use HasFactory;

    protected $table = 'store_pay_remind_settings';

    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}