<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carousel extends Model
{
    use HasFactory;

    protected $table = 'carousel';

    protected $guarded  = [];

    public $timestamps = true;
}
