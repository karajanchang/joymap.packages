<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemTaskLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo(SystemTask::class, 'system_task_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
