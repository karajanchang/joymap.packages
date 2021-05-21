<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreBusinessTime extends Model
{
    use HasFactory;

    protected $table = 'store_business_time';

    public $timestamps = false;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\StoreBusinessTimeFactory::new();
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
