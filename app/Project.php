<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['name', 'description'];

    public function assets(){
        return $this->hasMany(Asset::class, 'project_id', 'id');
    }
    /*Obtiene los proyectos ['name'=>'id'] para el select*/
    public static function getSelectProjects(){
        return self::all()->pluck('name', 'id');
    }
}
