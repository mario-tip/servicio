<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name','description', 'address', 'building', 'floor', 'shelf', 
      'area','hall','room','compartment','notes','codigo_rfid','loc_2d'
    ];

    public function assets(){
        return $this->belongsToMany('App\Asset', 'inventory', 'location_id', 'asset_id');
    }

    public static function getSelectLocation(){
      return self::all()->pluck('area','id');
    }
}
