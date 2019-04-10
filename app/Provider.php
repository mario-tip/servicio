<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{

    protected $table = 'providers';

    protected $fillable = [
        'name', 'email', 'address', 'city', 'zip_code', 'phone', 'contact_email', 'contact_phone', 'contact',
        'website', 'notes', 'state_id'
    ];

    public function assets(){
        return $this->hasMany('App\Asset', 'provider_id', 'id');
    }

    public function state(){
        return $this->hasOne('App\State', 'state_id', 'id');
    }

    public function receptions(){
        return $this->hasMany('App\Reception', 'provider_id', 'id');
    }

    public function products(){
        return $this->hasMany('App\Product', 'provider_id', 'id');
    }

    public static function getSelectProvider(){
      return self::all()->pluck('name','id');
    }
}
