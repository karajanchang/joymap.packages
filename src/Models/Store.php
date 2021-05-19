<?php

namespace Joymap\Models;


use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';

    public $timestamps = true;

    protected $guarded = ['id'];



}