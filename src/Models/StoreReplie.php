<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreReplie extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store_replies';

    public $timestamps = true;

    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function storeUser()
    {
        return $this->belongsTo(StoreUser::class);
    }
}
