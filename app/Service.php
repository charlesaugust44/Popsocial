<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'min', 'max', 'thousandPrice', 'promotionPrice', 'typeId'];

    public $timestamps = false;
    /**
     * @var Client Client
     */
    private $client;

    /**
     * Service constructor.
     * @param Client $client
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    public function purchases()
    {
        return $this->hasMany('App\Purchase', 'serviceId');
    }

    public function type()
    {
        return $this->belongsTo('App\Type', 'typeId');
    }

    public function getAll()
    {
        return handleHTTPCode(function () {
            $response = $this->client->request('GET', env('API_URL') . "/service", [
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