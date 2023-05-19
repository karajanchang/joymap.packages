<?php

namespace Joymap\Models;

use Fureev\Trees\{NestedSetTrait,Contracts\TreeConfigurable};
use Fureev\Trees\Config\Base;
use Fureev\Trees\Config\LeftAttribute;
use Fureev\Trees\Config\RightAttribute;
use Fureev\Trees\Config\LevelAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberDealerRelation extends Model implements TreeConfigurable
{
    use NestedSetTrait;
    use HasFactory;

    protected $table = 'member_dealer_relations';

    protected $guarded = [];

    protected static function buildTreeConfig(): Base
    {
        $base = new Base();
        $base->setAttribute('left', app(LeftAttribute::class)->setName('left_offset'))
             ->setAttribute('right', app(RightAttribute::class)->setName('right_offset'))
             ->setAttribute('level', app(LevelAttribute::class)->setName('level'));
        return $base;
    }

    public function memberDealer()
    {
        return $this->belongsTo(MemberDealer::class);
    }

}
