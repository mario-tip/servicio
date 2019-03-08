<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    public static function getSelectStates(){
        return self::all()->pluck('name', 'id');
    }
}
