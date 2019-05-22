<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Service;
use App\Status;
use App\Type;
use App\User;
use App\View\Redirect;

class ClientsController extends Controller
{
    private function managerData()
    {
        $userId = $_SESSION['user']['id'];

        $user = new User();
        $purchase = new Purchase();

        $user = $user->getById($userId);
        if (isRedirect($user))
            return $user;

        $doneQuantity = $purchase->getQuantityByStatusByUser(Status::DONE, $userId);
        if (isRedirect($doneQuantity))
            return $doneQuantity;

        $processingQuantity = $purchase->getQuantityByStatusByUser(Status::PROCESSING, $userId);
        if (isRedirect($processingQuantity))
            return $processingQuantity;

        return [
            'user' => $user,
            'processingQuantity' => $processingQuantity,
            'doneQuantity' => $doneQuantity
        ];
    }

    public function index()
    {
        $managerData = $this->managerData();

        if ($managerData instanceof Redirect)
            return $managerData->go();

        $data = [
            'content' => 'manager_menu',
            'manager' => $managerData
        ];

        return view('manager', $data);
    }

    public function order($networkId)
    {
        $type = new Type();
        $service = new Service();

        $managerData = $this->managerData();
        if (isRedirect($managerData))
            return $managerData->go();

        $types = $type->getByNetwork($networkId);
        if (isRedirect($types))
            return $types->go();

        $services = $service->getAll();
        if (isRedirect($services))
            return $services->go();

        $data = [
            'content' => 'order_form',
            'manager' => $managerData,
            'types' => $types,
            'services' => $services
        ];

        return view('manager', $data);
    }
}