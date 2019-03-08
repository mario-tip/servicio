<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;
use Illuminate\Support\Facades\Log;

class Person extends Model {
    protected $table = 'persons';

    protected $fillable = [
        'name', 'father_last_name', 'mother_last_name', 'email', 'address', 'alt_address', 'zip_code', 'phone',
        'alt_phone', 'city', 'company_position', 'company_name', 'company_address', 'company_phone', 'notes',
        'state_id', 'department_id', 'user_id'
    ];

    public function maintenances(){
        return $this->hasMany(Maintenance::class, 'person_id', 'id');
    }

    public function incidents(){
        return $this->hasMany(Incident::class, 'person_id', 'id');
    }

    public function assets(){
        return $this->hasMany(Asset::class, 'person_id', 'id');
    }
    /*public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }*/

    /*public function notifyCreatedUser($email, $password){
        $body = "Usuario creado:  \n" .
                "Usuario: " . $email . "\n" .
                "Contraseña: " . $password;

        Mail::raw($body, function($message) use ($email){
            $message->from('gmessoft@gmail.com', 'Altatec');
            $message->to($email)->subject('Usuario creado');
        });
    }*/
}
