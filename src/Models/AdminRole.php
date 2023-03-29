<?php

namespace Joymap\Models;

use Carbon\Carbon;

class AdminRole extends Model
{

    protected $table = 'admin_roles';

    protected $guarded  = [];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d H:i:s');
    }

    /**
     * 取得此角色擁有的權限
     */
    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class, 'admin_role_has_admin_permissions', 'role_id', 'permission_id');
    }
}
