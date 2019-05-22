<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'networkId'];

    public $timestamps = false;

    /**
     * @var Client $client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function services()
    {
        return $this->hasMany('App\Service', 'typeId');
    }

    public function network()
    {
        return $this->belongsTo('App\Network', 'networkId');
    }

    public function getByNetwork($networkId)
    {
        return handleHTTPCode(function () use ($networkId) {
            $response = $this->client->request('GET', env('API_URL') . "/type/network/" . $networkId, [
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