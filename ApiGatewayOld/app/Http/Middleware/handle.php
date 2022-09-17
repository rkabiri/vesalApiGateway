<?php


namespace App\Http\Middleware;


class handle
{
    public function handle($request, Closure $next)
    {
        $allowedSecrets = explode(',', env('ALLOWED_SECRETS'));
        if (in_array($request->header('Authorization'), $allowedSecrets)) {
            return $next($request);
        }
        abort(Response::HTTP_UNAUTHORIZED);
    }
}
