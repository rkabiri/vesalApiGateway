<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiGatewayAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('token')){
            return $this->authenticateError();
        }
        $token = $request->get('token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('AUTH_SERVICE_BASE_URI').'/auth/check?token='.$token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ));
        $response = json_decode(curl_exec($curl),true);
        curl_close($curl);
        if ($response['status']!=1000){
            return $this->authenticateError();
        }
        return $next($request);
    }


    private function authenticateError(){
        return response()->json([
            'status'=>1001,
            'success'=>false,
            'data'=>[
                'msg'=>__('خطای احراز هویت')
            ]
        ],401);
    }
}
