<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // DB_CONNECTION=mysql
    // DB_HOST=127.0.0.1
    // DB_PORT=3306
    // DB_DATABASE=vesal_users_ms
    // DB_USERNAME=root
    // DB_PASSWORD=

    // php artisan migrate
    // php artisan db:seed --class=UserTableSeeder
    // composer dump-autoload -o


    /**
     * @param $token
     * @return array
     */
    protected function respondWithTokenArray($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->guard('api')->user(),
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60 * 24 * 100
        ];
    }

}
