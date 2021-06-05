<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
