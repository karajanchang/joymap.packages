<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

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
