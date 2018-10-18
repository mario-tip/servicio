<?php
function user_can()
{
    $user = Auth::user();
    $role = $user->roles()->where('role_id', 3)->first();
    if (isset($role)) {
        return true;
    } else {
        return false;
    }
}

//Revisa si el usuario logueado tiene el permiso
function userHasPermission($permission)
{
    //Si usuario está logueado revisamos el permiso
    if (Auth::check()):
        $user_permissions = Auth::user()->roles[0]->permissions;

        foreach ($user_permissions as $user_permission) {
            if ($user_permission->name == $permission) {
                return true;
            }
        }
        return false;
    else: //Usuario no logueado
        return false;
    endif;

}

//Función para conectarse a base de datos dinámica
function setConnection($company_id)
{
    \Config::set('database.connections.tenant', array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'altatec_bd_' . $company_id,
        'username' => 'root',
        'password' => 'uranirvash12',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ));
    \DB::setDefaultConnection('tenant');
}