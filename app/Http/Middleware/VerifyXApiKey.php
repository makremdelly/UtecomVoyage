<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Config;

class VerifyXApiKey
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
        $key = config('app.x_api_key');
        $headerKey = Request::header('x-api-key');
        if($key != $headerKey) {
            return response()->json([
                'error' => 'xapikey'
            ], 401);
        } else {
            return $next($request);
        }
    }
}
