<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User;
use App\Http\Model\User_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Crypt;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
//        判断用户是否记住密码
        $cookie = $request->cookie('admin');
        if (session('adminFlag')) {
            return redirect('admin/index');
        }
        //加载登录视图
        return view('home.login.login',['cookie'=>$cookie]);
    }

    //登录验证
    public function logindo(Request $request)
    {
        //获取输入的值
        $request -> except('_token');
        //查询用户名是否存在
        $res = User::where('user_email',$request['username']) -> orwhere('user_phone',$request['username']) ->first();
//        dd($res);
        if(!$res){
            //不存在 返回
            return back()->with('error','用户不存在');
        }else{
            //存在 查询密码是否正确
            if(Crypt::decrypt($res['user_password'])!=$request['user_password'])
            {
                //不正确 返回
                return back()->with('errors','账号或密码错误');
            }else{
                if($res['status']>0){
                    //查询昵称
                    $dd = User_details::where('user_id',$res['user_id'])->first();
                    //用户加入session
                    session(['logins'=>$res]);
                    //昵称加入session
                    session(['deta_name'=>$dd['deta_name']]);
                    $lasttime = ['lasttime'=>time()];
                    //判断是否记住密码
                    if(!empty($res['remember'])){
                        Cookie::queue('admin',$res,10080);
                    }else{
                        Cookie::queue('admin','',-1);
                    }
                    User::where('user_id',$res['user_id']) -> update($lasttime);
                    //正确 返回主页
                    return redirect('/');
                }else{
                    return back()->with('activation','请激活后重新登录');
                }
            }
        }
    }
}
