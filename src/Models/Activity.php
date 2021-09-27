<?php

namespace Joymap\Models;


class Activity extends Model
{
    protected $table = 'activities';

    protected $guarded  = [];

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
