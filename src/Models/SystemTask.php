<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemTask extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function logs()
    {
        return $this->hasMany(SystemTaskLog::class, 'system_task_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
