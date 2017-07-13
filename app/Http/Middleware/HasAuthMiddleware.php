<?php

namespace App\Http\Middleware;

use Closure;
use App\http\Model\admin;

class HasAuthMiddleware
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

         //获取所请求的方法名字
        $route = \Route::current()->getName();
        //获取登录用户角色
        $roles = Admin::find(session('admin')['admin_id'])->roles()->get();
        // dd($roles);
        //获取角色权限
        $arr = [];
        foreach ($roles as $k => $role) {
            $auths = $role -> auths()->get();
            foreach($auths as $kk => $auth){
                $arr[]=$auth['auth_content'];
            }
        }
        //将重复的权限去掉
        $arr = array_unique($arr);

        //判断用户是否拥有权限
        if(!in_array($route,$arr)){
            return redirect('admin/back');
        }
        
        // dd($arr);
        return $next($request);
        
    }
}
