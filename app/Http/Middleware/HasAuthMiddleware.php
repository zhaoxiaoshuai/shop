<?php

namespace App\Http\Middleware;

use Closure;
use App\http\Model\Admin;
use App\http\Model\Auth;

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
         $route = \Route::current()->getActionName();
        //获取登录用户角色
         $roles = Admin::find(session('admin')['admin_id'])->roles()->get();
        //获取角色权限
         $auths = [];
         foreach ($roles as $k => $role) {
             $a = $role -> auths() -> get()->toArray();
             $auths = array_merge($auths,$a);
         } 
         //获取子权限
        $auths =  self::getAuth($auths);
        //取出权限内容
         $arr = [];
        foreach($auths as $kk => $auth){
            $arr[]=$auth['auth_content'];
        }
        //将重复的权限去掉
        $arr = array_unique($arr);
        //判断用户是否拥有权限
        if(!in_array($route,$arr)){
            return redirect('admin/back');
        }
        return $next($request);
    }


    public function getAuth($auths)
    {   
        $arr = [];
        // dd($auths);
        foreach($auths as $k => $v){
            // dump($v['auth_id']);
            $arr[] = $v['auth_id'];

        }
        // dd($arr);
        $x = Auth::whereIn('auth_group',$arr) -> get() -> toArray();

        return array_merge($auths,$x);
    }
}
