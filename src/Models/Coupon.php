<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $guarded = [];

}
