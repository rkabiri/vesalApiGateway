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

    $router->group([
        'prefix' => 'auth'
    ], function () use ($router) {


    });
});


$router->get('/', function () use ($router) {
    echo "<center> Welcome </center>";
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix' => 'api'
], function ($router) {

    $router->group([
        'prefix' => 'auth'
    ], function () use ($router) {
        $router->post('/login', ['uses' => 'AuthController@login']);
        $router->post('/refresh', ['uses' => 'AuthController@refresh']);
        $router->post('/check', ['uses' => 'AuthController@check']);
        $router->post('/logout', ['uses' => 'AuthController@logout']);
    });

    $router->group([
        'prefix' => 'users'
    ], function () use ($router) {
        $router->post('/register', ['uses' => 'UserController@register']);
        $router->post('/verify-pass', ['uses' => 'UserController@verifyPass']);
        $router->post('/user-profile', ['uses' => 'UserController@me']);
    });

});
