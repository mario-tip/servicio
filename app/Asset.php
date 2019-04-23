<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
      'equipment_id','asset_custom_id','project_id','model','name','serial','brand','adquisition_date',
      'barcode','cost','condition','status','person_id','expires_date','description','purchase_order',
      'maintenance_date','notes','provider_id','deleted_at','subcategory_id','customer_id',
      'depreciation','quantity','code_rfid','image','document'
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

    public function dame($date, $discount, $cost){

      $datework = Carbon::parse($date);
      $now = Carbon::now();
      $testdate = $datework->diffInDays($now);

      if ($testdate > 365) {
        $var = ($cost * $discount) / 100;
        $descuento = $var / $testdate;
        return $cost - $descuento + 0;
      }
    }

    // public function setProjectIdAttribute($value)
    // {
    //     var_dump("Quiere entrar a hacer nulo el project ID");
    //     if($value == '') {
    //         $this->attributes['project_id'] = null;
    //     }
    // }
}
