<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreSpgateway extends Model
{
    use HasFactory;

    protected $table = "store_spgateway";

    protected $guarded  = [];

    public $timestamps = false;

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
