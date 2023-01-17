<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreTable extends Model
{
    use HasFactory;

    protected $table = 'store_tables';

    public $timestamps = true;

    protected $guarded = [];

    public function storeFloor()
    {
        return $this->belongsTo(StoreFloor::class);
    }

    public function storeTableCombinations()
    {
        return $this->hasMany(StoreTableCombination::class);
    }

    public function combineTables()
    {
        return $this->hasManyThrough(StoreTable::class, StoreTableCombineSetting::class, 'store_table_id', 'combine_table_id');
    }
}
