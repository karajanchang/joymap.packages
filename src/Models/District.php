<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected $table = "districts";

    protected $guarded  = [];
    
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'district_id');
    }
}
