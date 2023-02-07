<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreFloor extends Model
{
    use HasFactory;

    protected $table = 'store_floors';

    public $timestamps = true;

    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    public function storeTables()
    {
        return $this->hasMany(\App\Models\StoreTable::class);
    }

    public function storeTableCombinations()
    {
        return $this->hasMany(\App\Models\StoreTableCombination::class);
    }

    public function storeFloorMap()
    {
        return $this->hasOne(\App\Models\StoreFloorMap::class);
    }
}
