<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories_permission extends Model
{
    protected $table = 'categories_permission';

    protected $fillable = [
        'name'
        ];

    public function permissions()
    {
        // return $this->hasMany('App\Permission');
        return $this->hasMany(Permissions::class,'category_id','id');
    }

}
