<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Firmware extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'firmwares';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firmware', 'date', 'risk', 'previous_firmware', 'observations', 'assets_id'];

    protected $firmware_risks = [
        '0' => 'Low',
        '1' => 'Medium',
        '2' => 'High'
    ];

    public function asset() {
        return $this->belongsTo('App\Asset', 'assets_id', 'id');
    }

    /*Accessors to change dates format*/
    public function getDateAttribute($value) {
        return isset($value) ? Carbon::parse($value)->format('d-m-Y') : null;
    }
    public function getRiskAttribute($value) {
        return $this->firmware_risks[$value];
    }
}
