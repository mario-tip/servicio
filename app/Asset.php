<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
      'asset_custom_id','project_id','model','name','serial','brand','adquisition_date','barcode',
      'cost','condition','status','person_id','expires_date','description','purchase_order',
      'maintenance_date','notes','provider_id','deleted_at','subcategory_id','customer_id','equipment_id',
    ];

    public function images(){
        return $this->morphMany(Image::class, 'parent');
    }

    public function customers(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function maintenances(){
        return $this->hasMany(Maintenance::class, 'asset_id', 'id');
    }

    public function incidents(){
        return $this->hasMany(Incident::class, 'asset_id', 'id');
    }

    public function person(){
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public function locations(){
        return $this->belongsToMany(Location::class, 'inventory', 'asset_id', 'location_id');
    }

    public function parts(){
        return $this->belongsToMany(Part::class, 'asset_part_equipment', 'asset_id', 'part_id')
            ->withPivot('serial');
    }

    public function provider(){
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function project(){
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function firmwares() {
        return $this->hasMany(Firmware::class, 'assets_id', 'id');
    }

    public function equipment(){
        return $this->belongsTo(Equipment::class, 'equipment_id', 'id');
    }

    /*Accessors to change dates format*/
    // FIXME: al parecer esto no se esta usando
    public function getAdquisitionDateAttribute($value) {
        return isset($value) ? Carbon::parse($value)->format('d-m-Y') : null;
    }
    public function getExpiresDateAttribute($value) {
        return isset($value) ? Carbon::parse($value)->format('d-m-Y') : null;
    }
    public function getMaintenanceDateAttribute($value) {
        return isset($value) ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    // public function setProjectIdAttribute($value)
    // {
    //     var_dump("Quiere entrar a hacer nulo el project ID");
    //     if($value == '') {
    //         $this->attributes['project_id'] = null;
    //     }
    // }
}
