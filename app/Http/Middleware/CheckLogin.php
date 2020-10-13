<?php

namespace App\Http\Middleware;
use Closure;

class CheckLogin
{
    public function handle($request,Closure $next){
        $user_id = $request->session()->get('uid');
        if(empty($user_id)){
            return redirect('/wo/logindo')->with(['msg'=>'请先登录']);
        }
        return $next($request);
    }
}
