<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StorePayment extends Model
{
    use HasFactory;

    protected $table = 'store_payments';

    public $timestamps = false;

    protected $guarded = [];
}
