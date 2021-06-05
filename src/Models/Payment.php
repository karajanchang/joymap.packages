<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected static function newFactory()
    {
        return \Joymap\database\factories\PaymentFactory::new();
    }

    protected $table = 'payments';

    public $timestamps = true;

    protected $guarded = [];

    public function storePayments()
    {
        return $this->hasMany(StorePayment::class);
    }
}
