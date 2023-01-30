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
        return $this->belongsToMany(StoreTable::class,'store_table_combine_setting','store_table_id','combine_table_id');
    }
}
