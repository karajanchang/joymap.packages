<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreTableCombination extends Model
{
    use HasFactory;

    protected $table = 'store_table_combinations';

    public $timestamps = true;

    protected $guarded = [];

    protected $casts = [
        'combination' => 'array',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function storeFloor()
    {
        return $this->belongsTo(StoreFloor::class);
    }

    public function storeTable()
    {
        return $this->belongsTo(StoreTable::class);
    }

}
