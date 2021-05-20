<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Joymap\Database\Factories\StoreUserFactory;
// use Database\Factories\StoreFactory

class StoreUser extends Model
{
    use HasFactory, SoftDeletes;

    protected static function newFactory()
    {
        return \Joymap\Database\Factories\StoreUserFactory::new();
    }

    protected $table = 'store_users';

    public $timestamps = true;

    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function role()
    {
        return $this->belongsTo(StoreRole::class);
    }

    public function storeReplies()
    {
        return $this->hasMany(StoreReplie::class);
    }

    public function passwordValidates()
    {
        return $this->hasMany(StoreUserPasswordValidate::class);
    }
}
