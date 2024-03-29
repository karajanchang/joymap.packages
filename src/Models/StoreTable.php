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
        return $this->belongsTo(\App\Models\StoreFloor::class);
    }

    public function combineTables()
    {
        return $this->belongsToMany(\App\Models\StoreTable::class,'store_table_combine_setting','store_table_id','combine_table_id');
    }
}
