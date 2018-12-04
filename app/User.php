<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'address',
        'is_central',
        'type_user',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($valor)
    {
        if (!empty($valor)) {
            $this->attributes['password'] = bcrypt($valor);
        }
    }

    public static $validationRules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public static $validationMessages = [
        'email.required' => 'El correo electrónico en requerido',
        'email.email' => 'El correo electrónico debe seguir el formato indicado',
        'password.required' => 'La contraseña es requerida'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'users_customers', 'user_id', 'customer_id');
    }

    /*Obtiene los técnicos ['name'=>'id'] para el select (se dan de alta desde sistema central)*/
    public static function getSelectTechnicians()
    {
        return self::select('users.name', 'users.id')
                ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
                ->where('roles.name', 'tecnico')->get()->pluck('name', 'id');
    }
}
