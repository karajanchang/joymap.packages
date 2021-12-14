<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ranking extends Model
{
    use HasFactory;

    protected $table = 'ranking';

    public $timestamps = true;

    protected $guarded = [];
}
