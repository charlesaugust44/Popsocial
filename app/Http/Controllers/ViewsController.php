<?php

namespace App\Http\Controllers;

use App\View\View;

class ViewsController extends Controller
{
    public function index()
    {
        $view = new View('index');
        return $view;
    }

    public function manager()
    {
        $view = new View("manager");

        $view->add('contentImport', 'manager_menu');

        return $view;
    }
}