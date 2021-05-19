<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreUserPasswordValidate extends Model
{
    use HasFactory;

    protected $table = 'store_user_password_validates';

    public $timestamps = true;

    protected $guarded = [];
}
