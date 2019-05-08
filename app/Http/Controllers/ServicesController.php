<?php

namespace App\Http\Controllers;

use App\Service;
use App\Type;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function create(Request $request)
    {
        $service = Service::query()->create($request->all());

        return response()->json($service->id, 201);
    }

    public function read($id)
    {
        $service = Service::query()->findOrFail($id);

        return response()->json($service);
    }

    public function readAll()
    {
        $services = Service::all();

        if (count($services) == 0)
            return response(null, 204);

        return response()->json($services);
    }

    public function readByType($typeId)
    {
        Type::query()->findOrFail($typeId);

        $services = Service::query()
            ->where('typeId', '=', $typeId)
            ->get();

        if (count($services) == 0)
            return response(null, 204);

        return response()->json($services);
    }

    public function delete($id)
    {
        $service = Service::query()->findOrFail($id);

        $service->delete();

        return response(null, 204);
    }

    public function update(Request $request, $id)
    {
        $service = Service::query()->findOrFail($id);

        $service->fill($request->all());
        $service->save();

        return response(null, 204);
    }
}