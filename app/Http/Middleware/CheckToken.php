<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redis;

use Closure;

class CheckToken
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
        $token = $request->get('token');
        //echo $token;
        $redis_login_hash = 'h:xcx:login:'.$token;
        $login_info = Redis::hgetAll($redis_login_hash);
        echo '<pre>'; print_r($login_info); echo '</pre>';
        return $next($request);
    }
}
