<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    /**
 * The database table used by the model.
 *
 * @var string
 */
    protected $table = 'parts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'number', 'price', 'description','barcode', 'code_rfid'
    ];

    public function assets()
    {
        return $this->belongsToMany('App\Asset', 'asset_part_equipment', 'part_id', 'asset_id');
    }

    public function incidents()
    {
        return $this->belongsToMany('App\Incident', 'incident_part', 'part_id', 'incident_id');
    }

    public function quotations()
    {
        return $this->belongsToMany('App\Quotation', 'quotation_part', 'part_id', 'quotation_id');
    }

    public function equipments()
    {
        return $this->belongsToMany('App\Equipment', 'parts_equipment', 'part_id', 'equipment_id');
    }
}
