<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';

    protected $fillable = [
        'name',
    ];

    public function parts(){
        return $this->belongsToMany(Part::class, 'parts_equipment', 'equipment_id', 'part_id');
    }
    public function assets(){
        return $this->hasMany(Asset::class, 'equipment_id', 'id');
    }
}
