<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix' => 'api'
], function () use ($router) {

//    $app->get('/', ['middleware' => 'haspermission:backend-users-list', 'uses' => 'UsersController@all']);


    $router->group([
        'prefix' => 'profiles'
    ], function () use ($router) {

        $router->get('/', [
            'uses' => 'ProfileController@index',
            'middleware' => 'ApiGatewayAuthenticate'
        ]);

        $router->post('/store', ['uses' => 'ProfileController@store']);

        $router->get('/show/{profile}', [
            'uses' => 'ProfileController@show',
            'middleware' => 'ApiGatewayAuthenticate'
        ]);

        $router->patch('/update/{profile}', [
            'uses' => 'ProfileController@update',
            'middleware' => 'ApiGatewayAuthenticate'
        ]);

        $router->delete('/delete/{profile}', [
            'uses' => 'ProfileController@destroy',
            'middleware' => 'ApiGatewayAuthenticate']);
    });
});
