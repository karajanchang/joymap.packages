<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Broadcast extends Model
{
    use HasFactory;

    protected $table = 'broadcasts';

    protected $guarded  = [];

    public $timestamps = true;

    public function logs()
    {
        return $this->hasMany(BroadcastLog::class);
    }
}
