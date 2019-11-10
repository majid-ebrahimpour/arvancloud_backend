<?php

/*
|--------------------------------------------------------------------------
| User Module Routes
|--------------------------------------------------------------------------
*/

$router->group(['prefix' => 'auth'], function () use ($router)
{
    $router->post('/signIn', ['uses' => 'AuthController@signIn']);
    $router->post('/signUp', ['uses' => 'AuthController@signUp']);
});