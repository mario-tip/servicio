<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = ['name', 'path', 'parent_id', 'parent_type'];

    public function parent()
    {
        return $this->morphTo();
    }
}
