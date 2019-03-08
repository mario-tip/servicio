<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model{

    protected $table = 'customers';

    protected $fillable = [
        'idcustomer', 'name', 'type', 'username', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function assets(){
        return $this->hasMany(Asset::class, 'customer_id', 'id');
    }

    public function getTypeWord(){
        $types = [
            '1' => 'Company',
            '2' => 'Person',
            '3' => 'Contract'
        ];
        return $types[$this->type];
    }
    /*Obtiene los clientes ['name'=>'id'] para el select*/
    public static function getSelectCustomers(){
        return self::all()->pluck('name', 'id');
    }
}
