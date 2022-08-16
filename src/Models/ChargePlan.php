<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChargePlan extends Model
{
    use HasFactory;

    protected $table = "charge_plan";

    protected $guarded  = [];

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
