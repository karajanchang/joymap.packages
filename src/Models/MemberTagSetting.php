<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberTagSetting extends Model
{
    use HasFactory;

    protected $table = 'member_tag_settings';

    public $timestamps = false;

    protected $guarded = [];
}
