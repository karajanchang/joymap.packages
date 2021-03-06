<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->hasMany(StoreUser::class, 'role_id', 'id');
    }

    public function userPermissions()
    {
        return $this->hasMany(StoreUserPermission::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(StorePermission::class, 'store_user_permissions', 'store_role_id', 'store_permission_id');
    }
}
