<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['serviceId', 'quantity', 'link'];

    protected $attributes = [
        'status' => Status::PROCESSING,
        'userId' => 0
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

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function service()
    {
        return $this->belongsTo('App\Service', 'serviceId');
    }

    public function getQuantityByStatusByUser($status, $userId)
    {
        $status = Status::alias[$status];

        return handleHTTPCode(function () use ($status, $userId) {
            $response = $this->client->request('GET', env('API_URL') . "/purchase/" . $status . "/quantity/user/" . $userId, [
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