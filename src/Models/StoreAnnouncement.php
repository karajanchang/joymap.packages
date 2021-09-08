<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreAnnouncement extends Model
{
    use HasFactory;

    protected $table = 'store_announcements';

    public $timestamps = true;

    protected $guarded = [];

    public function logs()
    {
        return $this->hasMany(StoreAnnouncementLog::class);
    }
}
