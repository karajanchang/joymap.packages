<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreRole extends Model
{
    use HasFactory;

    protected $table = "store_roles";

    protected $guarded  = [];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
}

