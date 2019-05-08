<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $fillable = [
        'name', 'phone', 'email'
    ];

    protected $hidden = [
        'password', 'token', 'secret', 'isAdmin'
    ];

    protected $attributes = [
        'user' => 'not set',
        'cpf' => 'not set',
        'password' => 'not set',
        'isAdmin' => false
    ];

    public $timestamps = false;

    public function purchases()
    {
        return $this->hasMany('App\Purchase', 'userId');
    }
}
