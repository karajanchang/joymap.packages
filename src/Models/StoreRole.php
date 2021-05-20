<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreRole extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Joymap\database\factories\StoreRoleFactory::new();
    }

    protected $table = "store_roles";

    protected $guarded  = [];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function users()
    {
        return $this->hasMany(StoreUser::class);
    }

    public function userPermissions()
    {
        return $this->hasMany(StoreUserPermission::class);
    }
}
