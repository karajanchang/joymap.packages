<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreRestriction extends Model
{
    use HasFactory, SoftDeletes;

    protected static function newFactory()
    {
        return \Joymap\database\factories\StoreRestrictionFactory::new();
    }

    protected $table = 'store_restrictions';

    public $timestamps = true;

    protected $guarded = [];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
