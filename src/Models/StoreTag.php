<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store_tags';

    public $timestamps = true;

    protected $guarded = [];
}
