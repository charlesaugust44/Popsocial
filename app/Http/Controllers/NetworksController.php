<?php

namespace App\Http\Controllers;

use App\Network;

class NetworksController extends Controller
{
    public function read($id)
    {
        $network = Network::query()->findOrFail($id);

        return response()->json($network);
    }

    public function readAll()
    {
        $networks = Network::all();

        if (count($networks) == 0)
            return response(null, 204);

        return response()->json($networks);
    }

}
