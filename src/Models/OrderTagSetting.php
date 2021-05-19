<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderTagSetting extends Model
{
    use HasFactory;

    protected $table = 'order_tag_settings';
    
    public $timestamps = false;

    protected $guarded = [];
}
