<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    protected $fillable = [
        'name', 'email', 'address', 'city', 'zip_code', 'phone', 'contact_email', 'contact_phone', 'contact',
        'website', 'notes', 'state_id'
    ];

    public function assets(){
        return $this->hasMany(Asset::class, 'provider_id', 'id');
    }

    public function state(){
        return $this->hasOne(State::class, 'state_id', 'id');
    }

    public function receptions(){
        return $this->hasMany(Reception::class, 'provider_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'provider_id', 'id');
    }
}
