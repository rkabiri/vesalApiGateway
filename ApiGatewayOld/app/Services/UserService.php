<?php


namespace App\Services;


use App\Traits\RequestService;

class UserService
{
    use RequestService;
    public $baseUri;
    public $secret;
    public function __construct()
    {
        $this->baseUri = config('services.users.base_uri');
        $this->secret = config('services.users.secret');
    }

    public function login($params=[])
    {

        return $this->request('POST', '/api/auth/login',$params);
    }
    public function refresh($params=[])
    {
        return $this->request('POST', '/api/auth/refresh',$params);
    }
    public function check($params=[])
    {
        return $this->request('POST', '/api/auth/check',$params);
    }
    public function logout($params=[])
    {
        return $this->request('POST', '/api/auth/logout',$params);
    }



    public function register($params=[])
    {
        return $this->request('POST', '/api/users/register',$params);
    }

    public function verifyPass($params=[])
    {
        return $this->request('POST', '/api/users/verify-pass',$params);
    }
    public function userProfile($params=[])
    {
        return $this->request('POST', '/api/users/user-profile',$params);
    }

}
