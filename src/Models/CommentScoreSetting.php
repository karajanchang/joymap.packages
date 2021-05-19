<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentScoreSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comment_score_settings';

    protected $guarded = [];
}
