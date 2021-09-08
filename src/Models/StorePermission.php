<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorePermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store_permissions';

    public $timestamps = true;

    protected $guarded = [];

    public function userPermissions()
    {
        return $this->hasMany(StoreUserPermission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(StoreRole::class, 'store_user_permissions', 'store_permission_id', 'store_role_id');
    }
}
