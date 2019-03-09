<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    public function assets()
    {
        return $this->hasMany('App\Asset', 'project_id', 'id');
    }
    /*Obtiene los proyectos ['name'=>'id'] para el select*/
    public static function getSelectProjects()
    {
        return self::all()->pluck('name', 'id');
    }
}
