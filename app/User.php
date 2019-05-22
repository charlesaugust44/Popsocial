<?php

namespace App;

use GuzzleHttp\Client;
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

    /**
     * @var Client Client
     */
    private $client;

    public function __construct()
    {
        parent::__construct();
        $this->client = new Client();
    }

    public function purchases()
    {
        return $this->hasMany('App\Purchase', 'userId');
    }

    public function getById($id)
    {
        return handleHTTPCode(function () use ($id) {
            $response = $this->client->request('GET', env('API_URL') . "/user/" . $id, [
                'query' => [
                    "api_token" => $_SESSION['token']
                ]
            ]);

            if ($response->getStatusCode() != 200)
                return null;

            return json_decode($response->getBody());
        });
    }
}
