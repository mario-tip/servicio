<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{

    protected $table = 'maintenances';

    protected $fillable = [
      'type','is_periodical','notes','maintenance_date','is_annual',
      'is_monthly','is_biweekly','asset_id','person_id','maintenance_time'
    ];

    public function asset(){
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }

    public function person(){
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public function services(){
        return $this->morphMany(ServiceOrder::class, 'serviceable', 'type','type_id');
    }

    public static function getTypeWord($key){
        $maintenance_types = [
            '0' => 'Clean ',
            '1' => 'Repair'
        ];
        return $maintenance_types[$key];
    }

}
