<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'address',
        'is_central',
        'type_user',
        'active_notification',
        'active_notification_order',
        'active_notification_end',
        'customer_id',
        'img_url'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($valor){
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

    public function roles(){
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function customers(){
        return $this->belongsToMany('App\Customer', 'users_customers', 'user_id', 'customer_id');
    }

    /*Obtiene los técnicos ['name'=>'id'] para el select (se dan de alta desde sistema central)*/
    public static function getSelectTechnicians(){
        return self::select('users.name', 'users.id')
                ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
                ->where('roles.name', 'tecnico')->get()->pluck('name', 'id');
    }

    //Funcion que filtra las ordenes de servicio de el usuario logueado
    public function getOrders(){
        return $this->hasMany(ServiceOrder::class,'user_id','id');
    }

    public function getIncidents(){
        return $this->hasMany(Incident::class,'user_id','id');
    }

}
