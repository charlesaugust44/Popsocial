<?php

namespace App\Http\Controllers;

use App\Network;
use App\Purchase;
use App\Status;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{
    public function create(Request $request)
    {
        $purchase = new Purchase();

        $purchase->fill($request->all());
        $purchase->userId = Auth::user()->id;
        $purchase->save();

        return response()->json($purchase->id, 201);
    }

    public function read($id)
    {
        $purchase = Purchase::query()->findOrFail($id);

        $belong = function () use ($purchase) {
            if (Auth::user()->isAdmin)
                return true;

            return $purchase->userId == Auth::user()->id;
        };

        if (!$belong())
            return response("ok", 404);

        return response()->json($purchase);
    }

    public function readAll()
    {
        $equalsUser = function ($q) {
            $q->where('userId', Auth::user()->id);
        };

        $purchases = Network::whereHas('types.services.purchases', $equalsUser)
            ->with([
                'types' => function ($q) use ($equalsUser) {
                    $q->whereHas('services.purchases', $equalsUser);
                },
                'types.services' => function ($q) use ($equalsUser) {
                    $q->whereHas('purchases', $equalsUser);
                },
                'types.services.purchases' => $equalsUser
            ])->get();

        if (count($purchases) === 0)
            return response(null, 204);

        return response()->json($purchases);
    }

    public function readByUser($userId)
    {
        User::query()->findOrFail($userId);

        $equalsUser = function ($q) use ($userId) {
            $q->where('userId', $userId);
        };

        $purchases = Network::whereHas('types.services.purchases', $equalsUser)
            ->with([
                'types' => function ($q) use ($equalsUser) {
                    $q->whereHas('services.purchases', $equalsUser);
                },
                'types.services' => function ($q) use ($equalsUser) {
                    $q->whereHas('purchases', $equalsUser);
                },
                'types.services.purchases' => $equalsUser
            ])->get();

        if (count($purchases) === 0)
            return response(null, 204);

        return response()->json($purchases);
    }

    public function delete($id)
    {
        $purchase = Purchase::findOrFail($id);

        if ($purchase->userId != Auth::user()->id)
            return response(null, 404);

        $purchase->delete();

        return response(null, 204);
    }

    public function update(Request $request, $id)
    {
        $purchase = Purchase::query()->findOrFail($id);

        $purchase->status = $request->input('status');
        $purchase->save();

        return response(null, 204);
    }

}
