<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentScoreSetting extends Model
{
    use HasFactory;

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
