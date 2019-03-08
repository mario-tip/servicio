<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model{

    protected $table = 'parts';

    protected $fillable = [
        'name', 'number', 'price', 'description',
    ];

    public function assets(){
        return $this->belongsToMany(Asset::class, 'asset_part_equipment', 'part_id', 'asset_id');
    }

    public function incidents(){
        return $this->belongsToMany(Incident::class, 'incident_part', 'part_id', 'incident_id');
    }

    public function quotations(){
        return $this->belongsToMany(Quotation::class, 'quotation_part', 'part_id', 'quotation_id');
    }

    public function equipments(){
        return $this->belongsToMany(Equipment::class, 'parts_equipment', 'part_id', 'equipment_id');
    }
}
