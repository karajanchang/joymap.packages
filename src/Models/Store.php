<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stores';

    public $timestamps = true;

    protected $guarded = ['id'];

    public function roles()
    {
        return $this->hasMany(StoreRole::class, 'store_id', 'id');
    }
}
