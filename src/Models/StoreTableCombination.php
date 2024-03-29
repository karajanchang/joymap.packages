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

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function store()
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    public function storeFloor()
    {
        return $this->belongsTo(\App\Models\StoreFloor::class);
    }
}
