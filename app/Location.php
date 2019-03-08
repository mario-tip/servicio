<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    protected $table = 'locations';

    protected $fillable = [
        'description', 'address', 'building', 'floor', 'shelf', 'area', 'hall', 'room', 'compartment', 'notes'
    ];

    public function assets(){
        return $this->belongsToMany(Asset::class, 'inventory', 'location_id', 'asset_id');
    }
}
