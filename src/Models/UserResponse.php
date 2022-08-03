<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserResponse extends Model
{
    use HasFactory;

    protected $table = 'user_response';

    protected $guarded  = [];

    public $timestamps = true;
}
