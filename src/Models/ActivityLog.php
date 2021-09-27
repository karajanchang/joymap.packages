<?php

namespace Joymap\Models;


class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $guarded  = [];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
