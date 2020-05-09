<?php

namespace App\Http\Middleware;

use Closure;
use Request;

class VerifyApiToken
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
        $apiToken = Request::header('Authorization');
        if(is_null($apiToken)) {
            return response()->json([
                'error' => 'api token'
            ], 401);
        } else {
            return $next($request);
        }
    }
}
