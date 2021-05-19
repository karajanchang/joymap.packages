<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreService extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store_services';

    public $timestamps = true;

    protected $guarded = [];

    public function settings()
    {
        return $this->hasMany(StoreServiceSetting::class);
    }
}
