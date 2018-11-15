<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Incident extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'incidents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'folio', 'type', 'description', 'suggested_date', 'suggested_time', 'priority', 'evidence_file', 'notes',
        'asset_id', 'person_id'
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

    public function parts()
    {
        return $this->belongsToMany('App\Part', 'incident_part', 'incident_id', 'part_id');
    }

    /*Accessors*/
    public function getSuggestedDateAttribute($value)
    {
        return isset($value) ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public static function getTypeWord($key)
    {
        $incident_types = [
            '0' => 'Limpieza',
            '1' => 'Reparación'
        ];
        return $incident_types[$key];
    }

    public static function getPriorityWord($key)
    {
        $incident_priorities = [
            '0' => 'Baja',
            '1' => 'Media',
            '2' => 'Alta'
        ];
        return $incident_priorities[$key];
    }
}
