<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    public $timestamps = false;

    public function types()
    {
        return $this->hasMany('App\Type', 'networkId');
    }

    public function typeServices()
    {
        return $this->hasManyThrough(
            'App\Service',
            'App\Type',
            'networkId',
            'typeId'
        );
    }
}