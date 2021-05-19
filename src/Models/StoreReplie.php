<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreReplie extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store_replies';

    public $timestamps = true;

    protected $guarded = [];
}
