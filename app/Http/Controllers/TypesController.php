<?php

namespace App\Http\Controllers;

use App\Network;
use App\Type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function create(Request $request)
    {
        $type = Type::query()->create($request->all());

        return response()->json($type->id, 201);
    }

    public function read($id)
    {
        $type = Type::query()->findOrFail($id);

        return response()->json($type);
    }

    public function readAll()
    {
        $types = Type::all();

        if (count($types) == 0)
            return response(null, 204);

        return response()->json($types);
    }

    public function readByNetwork($networkId)
    {
        Network::query()->findOrFail($networkId);

        $types = Type::query()
            ->where('networkId', '=', $networkId)
            ->get();

        if (count($types) == 0)
            return response(null, 204);

        return response()->json($types);
    }

    public function delete($id)
    {
        $type = Type::query()->findOrFail($id);

        $type->delete();

        return response(null, 204);
    }

    public function update(Request $request, $id)
    {
        $type = Type::query()->findOrFail($id);

        $type->fill($request->all());
        $type->save();

        return response(null, 204);
    }

}
