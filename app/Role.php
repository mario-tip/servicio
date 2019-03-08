<?php
namespace App;

use App\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'display_name',
        'description'];

    public function user(){
        return $this->belongsToMany(User::class, 'role_user', 'user_id', 'role_id');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}
