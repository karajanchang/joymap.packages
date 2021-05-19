<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreNotification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store_notifications';

    public $timestamps = true;

    protected $guarded = [];
}
