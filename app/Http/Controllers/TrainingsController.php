<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Http\Request;

class TrainingsController extends Controller
{
    public function create(Request $request)
    {
        $training = Training::query()->create($request->all());

        return response()->json($training->id, 201);
    }

    public function read($id)
    {
        $training = Training::query()->findOrFail($id);

        return response()->json($training);
    }

    public function readAll()
    {
        $trainings = Training::all();

        if (count($trainings) == 0)
            return response(null, 204);

        return response()->json($trainings);
    }

    public function delete($id)
    {
        $training = Training::query()->findOrFail($id);

        $training->delete();

        return response(null, 204);
    }

    public function update(Request $request, $id)
    {
        $training = Training::query()->findOrFail($id);

        $training->fill($request->all());
        $training->save();

        return response(null, 204);
    }

}
