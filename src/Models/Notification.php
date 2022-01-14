<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';

    public $timestamps = ["created_at"];

    const UPDATED_AT = null;

    protected $guarded = [];
}
