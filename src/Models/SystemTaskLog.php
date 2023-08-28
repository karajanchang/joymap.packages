<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemTaskLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];
}
