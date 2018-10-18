<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'resolutions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'signature', 'date', 'time', 'comments', 'service_order_id', 'person_id'
    ];

    public function service()
    {
        return $this->belongsTo('App\ServiceOrder', 'service_order_id', 'id');
    }
}
