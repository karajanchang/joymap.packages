<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreAnnouncementLog extends Model
{
    use HasFactory;

    protected $table = 'store_announcement_logs';

    public $timestamps = true;

    protected $guarded = [];
}
