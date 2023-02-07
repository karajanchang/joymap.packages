<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreFloorMap extends Model
{
    use HasFactory;

    protected $table = 'store_floor_maps';

    public $timestamps = true;

    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(\App\Models\StoreFloor::class);
    }
}
