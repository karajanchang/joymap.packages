<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentScoreSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comment_score_settings';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Joymap\database\factories\CommentScoreSettingFactory::new();
    }

    public function commentScores()
    {
        return $this->hasMany(CommentScore::class);
    }
}
