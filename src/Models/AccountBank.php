<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountBank extends Model
{
    use HasFactory;

    protected $table = "account_bank"; //rename memberbank -> account_bank

    protected $guarded = [];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}