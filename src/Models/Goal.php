<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

    protected $table = 'goals';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\GoalFactory::new();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
