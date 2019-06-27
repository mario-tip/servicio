<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{

    protected $table = 'maintenances';

    protected $fillable = [
        'type',
        'is_periodical',
        'notes',
        'maintenance_date',
        'is_annual',
        'is_monthly',
        'is_biweekly',
        'asset_id',
        'person_id',
        'maintenance_time',
        'user_id',
        'provider_id',
    ];

    public function asset()
    {
        return $this->belongsTo('App\Asset', 'asset_id', 'id')->with('location');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public function services()
    {
        return $this->morphMany('App\ServiceOrder', 'serviceable', 'type','type_id');
    }

    public function order(){
      return $this->belongsTo(ServiceOrder::class,'id','type_id')->with('person');
    }

    public static function getTypeWord($key)
    {
        $maintenance_types = [
            '0' => 'Clean ',
            '1' => 'Repair'
        ];
        return $maintenance_types[$key];
    }

}
