<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminUser extends Model
{
    use HasFactory;

    protected $table = "admin_users";

    protected $guarded  = [];

}
