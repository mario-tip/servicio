<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Asset extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_custom_id', 'model', 'name', 'serial', 'brand', 'adquisition_date', 'barcode', 'cost', 'condition',
        'status', 'person_id', 'expires_date', 'description', 'purchase_order', 'maintenance_date', 'notes',
        'provider_id', 'deleted_at', 'subcategory_id', 'customer_id', 'equipment_id', 'project_id'
    ];


    public function images()
    {
        return $this->morphMany('App\Image', 'parent');
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

    public function maintenances()
    {
        return $this->hasMany('App\Maintenance', 'asset_id', 'id');
    }

    public function incidents()
    {
        return $this->hasMany('App\Incident', 'asset_id', 'id');
    }

    public function person()
    {
        return $this->belongsTo('App\Person', 'person_id', 'id');
    }

    public function locations()
    {
        return $this->belongsToMany('App\Location', 'inventory', 'asset_id', 'location_id');
    }

    public function parts()
    {
        return $this->belongsToMany('App\Part', 'asset_part_equipment', 'asset_id', 'part_id')
            ->withPivot('serial');
    }

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'provider_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }

    public function firmwares() {
        return $this->hasMany('App\Firmware', 'assets_id', 'id');
    }

    public function equipment()
    {
        return $this->belongsTo('App\Equipment', 'equipment_id', 'id');
    }

    /*Accessors to change dates format*/
    public function getAdquisitionDateAttribute($value) {
        return isset($value) ? Carbon::parse($value)->format('d-m-Y') : null;
    }
    public function getExpiresDateAttribute($value) {
        return isset($value) ? Carbon::parse($value)->format('d-m-Y') : null;
    }
    public function getMaintenanceDateAttribute($value) {
        return isset($value) ? Carbon::parse($value)->format('d-m-Y') : null;
    }
    public function setProjectIdAttribute($value)
    {
        if($value == '') {
            $this->attributes['project_id'] = null;
        }
    }
}
