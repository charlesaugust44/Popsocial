<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;

class AlertsController extends Controller
{
    public function create(Request $request)
    {
        $alert = Alert::query()->create($request->all());

        return response()->json($alert->id, 201);
    }

    public function read($id)
    {
        $alert = Alert::query()->findOrFail($id);

        return response()->json($alert);
    }

    public function readAll()
    {
        $alerts = Alert::all();

        if (count($alerts) == 0)
            return response(null, 204);

        return response()->json($alerts);
    }

    public function delete($id)
    {
        $training = Alert::query()->findOrFail($id);

        $training->delete();

        return response(null, 204);
    }

    public function update(Request $request, $id)
    {
        $alert = Alert::query()->findOrFail($id);

        $alert->fill($request->all());
        $alert->save();

        return response(null, 204);
    }

}
