<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreRestriction extends Model
{
    use HasFactory;

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
