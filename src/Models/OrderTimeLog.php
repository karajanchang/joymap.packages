<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderTimeLog extends Model
{
    use HasFactory;

    protected $table = 'order_time_logs';
    
    public $timestamps = false;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\OrderTimeLogFactory::new();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
