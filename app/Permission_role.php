<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_role extends Model
{
    protected $table = 'permission_role';

    protected $fillable = [
      'permission_id',
      'role_id',
      ];

}
