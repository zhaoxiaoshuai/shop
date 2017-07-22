<?php

namespace App\Http\Middleware;

use Closure;

class HomeLoginMiddleware
{
    /**
     * 判断前台管理员是否登录
     *
     * @param  用户请求数据
     * @return 登录返回请求页面未登录返回登录页面
     * @author zxs
     * @Date 2017-7-8 
     */
    public function handle($request, Closure $next)
    {
        if(session('logins')){
            return $next($request);
        }else{
            return redirect('home/login');
        }
    }
}
