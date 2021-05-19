<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreServiceSetting extends Model
{
    use HasFactory;

    protected $table = 'store_service_settings';

    public $timestamps = false;

    protected $guarded = [];
}
