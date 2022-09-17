<?php

namespace App\Http\Middleware;

use Closure;

class assignHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $requestBearer = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6OTAwMVwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY2MzQwMzQwNiwiZXhwIjoxNjYzNDA3MDA2LCJuYmYiOjE2NjM0MDM0MDYsImp0aSI6IjlHSXIzdVpydU5wS01BNWciLCJzdWIiOjMsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.PSXplDqpr8lWpxrH6uftJWt3WVts9Sj38fSRCy8H35Q';
//        $requestBearer = $request->bearerToken();

        $token='Bearer '.$requestBearer;
        $response=$next($request);
        $response->header('Authorization',$token);

        return $next($request);
    }
}
