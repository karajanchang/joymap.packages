<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $table = "articles";

    protected $guarded  = [];

    public function logs()
    {
        return $this->hasMany(ArticleMark::class);
    }

}
