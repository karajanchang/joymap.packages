<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BroadcastLog extends Model
{
    use HasFactory;

    protected $table = 'broadcast_logs';

    protected $guarded  = [];

    public $timestamps = true;

    public function clicks()
    {
        return $this->hasMany(BroadcastClickLog::class);
    }

    public function broadcastBatchLogs()
    {
        return $this->hasMany(BroadcastBatchLog::class);
    }
}
