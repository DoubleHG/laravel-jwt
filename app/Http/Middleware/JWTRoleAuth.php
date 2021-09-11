<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTRoleAuth extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next ,$role = null)
    {

        try {
            $tokenRole = $this->auth->parseToken()->getClaim('id');
        }catch (JWTException  $exception){
            Log::error(sprintf('code:%s,msg:%s,trace:%s',$exception->getCode(),$exception->getMessage(),$exception->getTraceAsString()));

            return response()->json('token无效！');
        }

        if($tokenRole != $role){
            return response()->json('没有权限');
        }

        return $next($request);
    }
}
