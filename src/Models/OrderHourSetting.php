<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderHourSetting extends Model
{
    use HasFactory;

    protected $table = 'order_hour_settings';

    public $timestamps = false;

    protected $guarded = [];
}
