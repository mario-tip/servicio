<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idcustomer', 'name', 'type', 'username', 'password',
        'address','phone','adm_name','adm_phone','adm_email',
        'rfc','sup_name','sup_phone','sup_email','person_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function assets()
    {
        return $this->hasMany('App\Asset', 'customer_id', 'id');
    }

    public function getTypeWord()
    {
        $types = [
            '1' => 'Company',
            '2' => 'Person',
            '3' => 'Contract'
        ];
        return $types[$this->type];
    }
    /*Obtiene los clientes ['name'=>'id'] para el select*/
    public static function getSelectCustomers()
    {
        return self::all()->pluck('name', 'id');
    }
}
