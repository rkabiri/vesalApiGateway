<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $guzzle = new Client(['base_uri' => 'http://localhost:9000/api/auth/login']);
        $response = $guzzle->request('POST', 'http://localhost:9000/api/auth/login', [
            'json' => $request->all(),
        ]);
        $response =  $response->getBody()->getContents();
        return $response;
    }

    public function registerPage()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $guzzle = new Client(['base_uri' => 'http://localhost:9000/api/users/register']);
        $response = $guzzle->request('POST', 'http://localhost:9000/api/users/register', [
            'json' => $request->all(),
        ]);
        $response =  $response->getBody()->getContents();
        return $response;
    }




}
