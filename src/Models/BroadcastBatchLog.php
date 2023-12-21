<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BroadcastBatchLog extends Model
{
    use HasFactory;

    protected $table = 'broadcast_batch_logs';

    protected $guarded  = [];

    public $timestamps = true;

    public function broadcastLog()
    {
        return $this->hasOne(BroadcastLog::class);
    }
}
