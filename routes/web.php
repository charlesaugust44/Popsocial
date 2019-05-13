<?php

use Laravel\Lumen\Routing\Router;

function routes(Router $router)
{
    $router->get('/', 'ViewsController@index');

    $router->get('/manager', 'ViewsController@manager');

    $prefix = 'api';

    $router->group(['prefix' => "$prefix/user"], function (Router $router) {
        $router->post('', [
            'middleware' => 'authAll',
            'uses' => 'UsersController@create'
        ]);

        $router->get('/token', 'UsersController@token');

        $router->get('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'UsersController@read'
        ]);

        $router->get('', [
            'middleware' => 'authAdmin',
            'uses' => 'UsersController@readAll'
        ]);

        $router->put('', [
            'middleware' => 'authAll',
            'uses' => 'UsersController@update'
        ]);
    });

    $router->group(['prefix' => "$prefix/type"], function (Router $router) {
        $router->post('', [
            'middleware' => 'authAdmin',
            'uses' => 'TypesController@create'
        ]);

        $router->get('/{id}', [
            'middleware' => 'authAll',
            'uses' => 'TypesController@read'
        ]);

        $router->get('/network/{networkId}', [
            'middleware' => 'authAll',
            'uses' => 'TypesController@readByNetwork'
        ]);

        $router->get('', [
            'middleware' => 'authAll',
            'uses' => 'TypesController@readAll'
        ]);

        $router->delete('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'TypesController@delete'
        ]);

        $router->put('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'TypesController@update'
        ]);
    });

    $router->group(['prefix' => "$prefix/service"], function (Router $router) {
        $router->post('', [
            'middleware' => 'authAdmin',
            'uses' => 'ServicesController@create'
        ]);

        $router->get('/{id}', [
            'middleware' => 'authAll',
            'uses' => 'ServicesController@read'
        ]);

        $router->get('/type/{typeId}', [
            'middleware' => 'authAll',
            'uses' => 'ServicesController@readByType'
        ]);

        $router->get('', [
            'middleware' => 'authAll',
            'uses' => 'ServicesController@readAll'
        ]);

        $router->delete('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'ServicesController@delete'
        ]);

        $router->put('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'ServicesController@update'
        ]);
    });

    $router->group(['prefix' => "$prefix/network"], function (Router $router) {

        $router->get('/{id}', [
            'middleware' => 'authAll',
            'uses' => 'NetworksController@read'
        ]);

        $router->get('', [
            'middleware' => 'authAll',
            'uses' => 'NetworksController@readAll'
        ]);

    });

    $router->group(['prefix' => "$prefix/training"], function (Router $router) {
        $router->post('', [
            'middleware' => 'authAdmin',
            'uses' => 'TrainingsController@create'
        ]);

        $router->get('/{id}', [
            'middleware' => 'authAll',
            'uses' => 'TrainingsController@read'
        ]);

        $router->get('', [
            'middleware' => 'authAll',
            'uses' => 'TrainingsController@readAll'
        ]);

        $router->delete('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'TrainingsController@delete'
        ]);

        $router->put('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'TrainingsController@update'
        ]);
    });

    $router->group(['prefix' => "$prefix/alert"], function (Router $router) {
        $router->post('', [
            'middleware' => 'authAdmin',
            'uses' => 'AlertsController@create'
        ]);

        $router->get('/{id}', [
            'middleware' => 'authAll',
            'uses' => 'AlertsController@read'
        ]);

        $router->get('', [
            'middleware' => 'authAll',
            'uses' => 'AlertsController@readAll'
        ]);

        $router->delete('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'AlertsController@delete'
        ]);

        $router->put('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'AlertsController@update'
        ]);
    });

    $router->group(['prefix' => "$prefix/purchase"], function (Router $router) {
        $router->post('', [
            'middleware' => 'authClient',
            'uses' => 'PurchasesController@create'
        ]);

        $router->get('/{id}', [
            'middleware' => 'authAll',
            'uses' => 'PurchasesController@read'
        ]);

        $router->get('/user/{userId}', [
            'middleware' => 'authAdmin',
            'uses' => 'PurchasesController@readByUser'
        ]);

        $router->get('', [
            'middleware' => 'authClient',
            'uses' => 'PurchasesController@readAll'
        ]);

        $router->delete('/{id}', [
            'middleware' => 'authClient',
            'uses' => 'PurchasesController@delete'
        ]);

        $router->put('/{id}', [
            'middleware' => 'authAdmin',
            'uses' => 'PurchasesController@update'
        ]);
    });
}