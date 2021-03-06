<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodType extends Model
{
    use HasFactory;

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

    public function mainFoodType()
    {
        return $this->belongsTo(MainFoodType::class, 'id', 'main_food_type_id');
    }
}
