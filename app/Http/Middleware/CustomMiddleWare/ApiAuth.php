<?php

namespace App\Http\Middleware\CustomMiddleWare;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return helperJson(null,'Token is Invalid',406);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return helperJson(null,'Token is Expired',406);
            }else{
                return helperJson(null,'Authorization Token not found',405);
            }
        }
        return $next($request);
    }
}
