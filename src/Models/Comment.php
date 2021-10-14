<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\CommentFactory::new();
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function storeReplies()
    {
        return $this->hasMany(StoreReplie::class);
    }

    public function scores()
    {
        return $this->hasMany(CommentScore::class);
    }

    public function images()
    {
        return $this->hasMany(CommentImage::class);
    }
}
