<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentScore extends Model
{
    use HasFactory;

    protected $table = 'comment_scores';

    public $timestamps = false;

    protected $guarded = [];
}
