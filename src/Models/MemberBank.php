<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberBank extends Model
{
    use HasFactory;

    protected $table = "member_bank";

    protected $guarded  = [];

    public function bank()
    {
        return $this->hasOne(Bank::class);
    }
}
