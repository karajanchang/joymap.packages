<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberAppVersion extends Model
{
    use HasFactory;

    protected array $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}