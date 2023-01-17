<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreTableCombinationSetting extends Model
{
    use HasFactory;

    protected $table = 'store_table_combine_setting';

    public $timestamps = true;

    protected $guarded = [];

    public function storeTable()
    {
        return $this->belongsTo(StoreTable::class);
    }

    public function combine_table()
    {
        return $this->belongsTo(Store::class, 'combine_table_id');
    }

}
