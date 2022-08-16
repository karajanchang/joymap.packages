<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class JcTransaction extends Model
{
    use HasFactory;

    protected $table = "jc_transactions";

    protected $guarded  = [];
}
