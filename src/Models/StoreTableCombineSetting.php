<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreTableCombineSetting extends Model
{
    use HasFactory;

    protected $table = 'store_table_combine_setting';

    public $incrementing = false;

    public $timestamps = true;

    protected $guarded = [];

    public function storeTable()
    {
        return $this->belongsTo(\App\Models\StoreTable::class);
    }

    public function combineTable()
    {
        return $this->belongsTo(\App\Models\Store::class, 'combine_table_id');
    }

}
