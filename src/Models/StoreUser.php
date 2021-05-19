<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store_users';

    public $timestamps = true;

    protected $guarded = [];
}
