<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentScore extends Model
{
    use HasFactory;

    protected $table = 'comment_scores';

    public $timestamps = false;

    protected $primaryKey = null;

    public $incrementing = false;

    protected $guarded = [];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function setting()
    {
        return $this->belongsTo(CommentScoreSetting::class);
    }
}
