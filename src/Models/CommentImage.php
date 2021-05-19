<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comment_images';

    protected $guarded = [];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
