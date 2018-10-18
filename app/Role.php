<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'display_name', 'description'];

    public function user()
    {
        return $this->belongsToMany('App\User', 'role_user', 'user_id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id');
    }
}
