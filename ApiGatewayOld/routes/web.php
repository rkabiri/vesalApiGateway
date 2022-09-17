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


$router->get('/t', function (){
    return 'test';
});


$router->group(['prefix' => 'api', 'middleware' => [

]], function () use ($router) {

    $router->group(['prefix' => 'profiles'], function () use ($router) {

        $router->get('/', ['uses' => 'ProfileController@index']);
        $router->post('/store', ['uses' => 'ProfileController@store']);
        $router->get('/show/{profile}', ['uses' => 'ProfileController@show']);
        $router->patch('/update/{profile}', ['uses' => 'ProfileController@update']);
        $router->delete('/delete/{profile}', ['uses' => 'ProfileController@destroy']);

    });

    //  *****************************************************************************

//    $router->group(['prefix' => 'users'], function () use ($router) {
//        $router->get('/', ['uses' => 'UserController@index']);
//        $router->post('/store', ['uses' => 'UserController@store']);
//        $router->get('/show/{profile}', ['uses' => 'UserController@show']);
//        $router->patch('/update/{profile}', ['uses' => 'UserController@update']);
//        $router->delete('/delete/{profile}', ['uses' => 'UserController@destroy',]);
//    });

    $router->group([
        'prefix' => 'auth'
    ], function () use ($router) {
        $router->post('/login', ['uses' => 'UserController@login']);
        $router->post('/refresh', ['uses' => 'UserController@refresh']);
        $router->post('/check', ['uses' => 'UserController@check']);
        $router->post('/logout', ['uses' => 'UserController@logout']);
    });

    $router->group([
        'prefix' => 'users'
    ], function () use ($router) {
        $router->post('/register', ['uses' => 'UserController@register']);
        $router->post('/verify-pass', ['uses' => 'UserController@verifyPass']);
        $router->post('/user', ['uses' => 'UserController@userProfile']);
    });
});
