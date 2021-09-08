<?php

namespace Joymap\Models;

use Illuminate\Database\Eloquent\Model as baseModel;
use Joymap\Http\Traits\SerializeDateTrait;

class Model extends baseModel
{
    use SerializeDateTrait;
}
