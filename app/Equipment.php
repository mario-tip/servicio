<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'equipment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function parts()
    {
        return $this->belongsToMany('App\Part', 'parts_equipment', 'equipment_id', 'part_id');
    }
    public function assets()
    {
        return $this->hasMany('App\Asset', 'equipment_id', 'id');
    }
}