<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [
    'uses' => 'App\Http\Controllers\UserController@index',
    'as'=>'login.get'
]);

Route::post('/login', [
    'uses' => 'App\Http\Controllers\UserController@login',
    'as'=>'login.post'
]);

Route::get('/register', [
    'uses' => 'App\Http\Controllers\UserController@registerPage',
    'as'=>'register.get'
]);

Route::post('/register/post', [
    'uses' => 'App\Http\Controllers\UserController@register',
    'as'=>'register.post'
]);


