<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreUser extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Joymap\database\factories\StoreUserFactory::new();
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
        return $this->hasMany(StoreReply::class);
    }

    public function passwordValidates()
    {
        return $this->hasMany(StoreUserPasswordValidate::class);
    }
}
