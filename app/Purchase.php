<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['serviceId', 'quantity', 'link'];

    protected $attributes = [
        'status' => Status::PROCESSING,
        'userId' => 0
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function service()
    {
        return $this->belongsTo('App\Service', 'serviceId');
    }
}