<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'networkId'];

    public $timestamps = false;

    public function services()
    {
        return $this->hasMany('App\Service', 'typeId');
    }

    public function network()
    {
        return $this->belongsTo('App\Network', 'networkId');
    }
}