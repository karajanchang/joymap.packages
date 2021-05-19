<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreUserPermission extends Model
{
    use HasFactory;

    protected $table = 'store_user_permissions';

    public $timestamps = false;

    protected $guarded = [];
}
