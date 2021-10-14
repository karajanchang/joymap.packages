<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreService extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Joymap\database\factories\StoreServiceFactory::new();
    }

    protected $table = 'store_services';

    public $timestamps = true;

    protected $guarded = [];

    public function settings()
    {
        return $this->hasMany(StoreServiceSetting::class);
    }
}
