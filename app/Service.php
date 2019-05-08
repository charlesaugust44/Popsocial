<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'min', 'max', 'thousandPrice', 'promotionPrice', 'typeId'];

    public $timestamps = false;

    public function purchases()
    {
        return $this->hasMany('App\Purchase', 'serviceId');
    }

    public function type()
    {
        return $this->belongsTo('App\Type', 'typeId');
    }

}