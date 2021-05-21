<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'food_types';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\FoodTypeFactory::new();
    }

    public function stores()
    {
        return $this->hasMany(StoreFoodType::class);
    }
}
