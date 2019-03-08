<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    protected $table = 'resolutions';

    protected $fillable = [
        'signature', 'date', 'time', 'comments', 'service_order_id', 'person_id'
    ];

    public function service(){
        return $this->belongsTo(ServiceOrder::class, 'service_order_id', 'id');
    }
}
