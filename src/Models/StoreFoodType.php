<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreFoodType extends Model
{
    use HasFactory;

    protected $table = 'store_food_types';

    public $timestamps = false;

    protected $guarded = [];
}
