<?php

/*
|--------------------------------------------------------------------------
| Domain Module Routes
|--------------------------------------------------------------------------
*/

$router->get('/fetch', function () {
    echo 'q';
    exit;
});

$router->group(['prefix' => 'domain'], function () use ($router)
{

    $router->get('/{id}', ['uses' => 'DomainController@get']);

    $router->get('/', ['uses' => 'DomainController@getList']);

    $router->post('/', ['uses' => 'DomainController@create']);

    $router->put('/{id}', ['uses' => 'DomainController@update']);

    $router->delete('/{id}', ['uses' => 'DomainController@delete']);

    $router->delete('/', ['uses' => 'DomainController@deleteList']);

    $router->get('/verify/{id}', ['uses' => 'DomainController@verify']);

});