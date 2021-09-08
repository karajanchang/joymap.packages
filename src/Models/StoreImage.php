<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreImage extends Model
{
    use HasFactory;

    protected $table = 'store_images';

    public $timestamps = true;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\StoreImageFactory::new();
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
