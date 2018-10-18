<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maintenances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'is_periodical', 'notes', 'maintenance_date', 'is_annual', 'is_monthly', 'is_biweekly', 'asset_id', 'person_id', 'maintenance_time'
    ];

    public function asset()
    {
        return $this->belongsTo('App\Asset', 'asset_id', 'id');
    }

    public function person()
    {
        return $this->belongsTo('App\Person', 'person_id', 'id');
    }

    public function services()
    {
        return $this->morphMany('App\ServiceOrder', 'serviceable', 'type','type_id');
    }
}
