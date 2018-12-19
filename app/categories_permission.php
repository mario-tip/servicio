<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories_permission extends Model
{
    protected $table = 'categories_permission';

    protected $fillable = [
        'name'
        ];

    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

}
